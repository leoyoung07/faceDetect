<?php
include_once "connect.php";
include_once "similarity.php";
include_once "face_class.php";
include_once "xml.php";
include_once "gray.php";
$features = array("face","right_eye","left_eye","nose","mouth");
$loc = array("x","y","w","h");
$grayimg = "gray/gray-".basename($file_dir);
grayjpg($file_dir, $grayimg);
$detect_result = array();
$detect_result[0] = choose_max(face_detect($grayimg, $xml[0]));
for($i=1;$i<count($xml);$i++)
{
	
	$detect_result[$i] = choose_max(selector($detect_result[0],face_detect($grayimg, $xml[$i]),$features[$i]));
}


$type = $_POST["type"];

if($type=="search")
{

	$face1 = new face($detect_result[0],$detect_result[1],$detect_result[2],$detect_result[3],$detect_result[4]);
	//var_dump($face1);
	$sql = "select * from face;";
	$connect = connect();
	$result = $connect->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$pic_dir = array();
	$i = 0;
	while ($array = $result->fetch())
	{
		//var_dump($array);
		//echo "<br>";
		
		$temp_result = array();
		for ($i = 0; $i < count($features); $i++)
		{
			$temp_feature = array();
			for ($j = 0; $j < ($loc); $j++)
			{
				$temp_feature[$j] = $array[$features[$i]."_".$loc[$j]];
				
			}
			$temp_result[$i] = $temp_feature;
		}
		var_dump($temp_result);
		echo "<br>";
	}

//test codes
/*
	//var_dump($detect_result);
	include_once "test.php";
	foreach ($detect_result as $key => $value)
	{
		$test_pic = face_compare($grayimg,$value,$features[$key]);
		echo <<<EOT
		<img src="{$test_pic}">
EOT;
		echo "<br>";
	}

*/

}
else
{
	$size = (int)($file["size"]/1024);
	echo $file["name"]." is uploaded <br> size: ".(int)($file["size"]/1024)."kb<br>";
	$location = $_POST["location"];
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
				$features[$i]["x"]<=($face["x"]+$face["x"]+$face["w"])/2)
				{
					$temp[$j] = $features[$i];
					$j++;
				}
			//选出正确位置的左眼
			}else if ($type=="left_eye")
			{
				if ($features[$i]["y"]<=($face["y"]+$face["y"]+$face["h"])/2&&
				$features[$i]["x"]>=($face["x"]+$face["x"]+$face["w"])/2&&
				$features[$i]["x"]<=($face["x"]+$face["w"]))
				{
					$temp[$j] = $features[$i];
					$j++;
				}
			//选出正确位置的嘴
			}else if ($type=="mouth")
			{
				if ($features[$i]["y"]>=($face["y"]+$face["y"]+$face["h"])/2&&
				$features[$i]["y"]<=($face["y"]+$face["h"])&&
				$features[$i]["x"]<=($face["x"]+$face["w"]))
				{
					$temp[$j] = $features[$i];
					$j++;			
				}
			//选出正确位置的鼻子	
			}else
			{
				if ($features[$i]["y"]<=($face["y"]+$face["h"])&&
				$features[$i]["x"]<=($face["x"]+$face["w"]))
				{
					$temp[$j] = $features[$i];
					$j++;			
				}
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
