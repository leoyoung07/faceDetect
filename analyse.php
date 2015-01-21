<?php
include_once "connect.php";



$type = $_POST["type"];

if($type=="search")
{
	include_once "similarity.php";
	include_once "face_class.php";
	include_once "xml.php";
	include_once "gray.php";
	$loc = array("face","right_eye","left_eye","nose","mouth");
	$grayimg = "gray/gray-".basename($file_dir);
	grayjpg($file_dir, $grayimg);
	$detect_result = array();
	$detect_result[0] = choose_max(face_detect($grayimg, $xml[0]));
	for($i=1;$i<count($xml);$i++)
	{
		
		$detect_result[$i] = choose_max(selector($detect_result[0],face_detect($grayimg, $xml[$i]),$loc[$i]));
	}
	
	
	var_dump($detect_result);
	include_once "test.php";
	foreach ($detect_result as $key => $value)
	{
		$test_pic = face_compare($grayimg,$value,$loc[$key]);
		echo <<<EOT
		<img src="{$test_pic}">
EOT;
		echo "<br>";
	}
	/*
	echo <<<EOT
		<img src="{$grayimg}">
	EOT;
	*/


}
else
{
	$size = (int)($file["size"]/1024);
	echo $file["name"]." is uploaded \n size: ".(int)($file["size"]/1024)."kb";
	include_once "insert.php";
}

function choose_max($features)
{
	$result = array();
	$max = 0;
	for ($i = 0; $i < count($features); $i++)
	{
		if ($features[$i]["w"]*$features[$i]["h"]>$max)
		{
			$max = $features[$i]["w"]*$features[$i]["h"];
			$result = $features[$i];
		}
		
	}
	return $result;
	
}

function selector($face,$features,$type)
{
	$temp = array();
	for ($i = 0,$j = 0; $i < count($features); $i++)
	{
		//选出人脸范围内的五官
		if ($features[$i]["x"]>=$face["x"]&&$features[$i]["y"]>=$face["y"]&&
		($features[$i]["x"])<=($face["x"]+$face["w"])&&
		($features[$i]["y"])<=($face["y"]+$face["h"]))
		{
			//选出正确位置的右眼
			if ($type=="right_eye")
			{
				if ($features[$i]["y"]<=($face["y"]+$face["y"]+$face["h"])/2&&
				($features[$i]["x"]+$features[$i]["x"]+$features[$i]["w"])/2<=($face["x"]+$face["x"]+$face["w"])/2)
				{
					$temp[$j] = $features[$i];
					$j++;
				}
			//选出正确位置的左眼
			}else if ($type=="left_eye")
			{
				if ($features[$i]["y"]<=($face["y"]+$face["y"]+$face["h"])/2&&
				($features[$i]["x"]+$features[$i]["x"]+$features[$i]["w"])/2>=($face["x"]+$face["x"]+$face["w"])/2)
				{
					$temp[$j] = $features[$i];
					$j++;
				}
			//选出正确位置的嘴
			}else if ($type=="mouth")
			{
				if ($features[$i]["y"]>=($face["y"]+$face["y"]+$face["h"])/2)
				{
					$temp[$j] = $features[$i];
					$j++;			
				}
				
			}else
			{
				$temp[$j] = $features[$i];
				$j++;
			}

			
		}
			
	}
	if (count($temp)==0)
	{
		$temp[0] = array("x"=>-1,"y"=>-1,"w"=>-1,"h"=>-1);
		
	}
	return $temp;
}

?>
