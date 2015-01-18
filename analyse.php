<?php
include_once "connect.php";



$type = $_POST["type"];

if($type=="search")
{
	include_once "similarity.php";
	include_once "face_class.php";
	include_once "xml.php";
	include_once "gray.php";
	$grayimg = "gray/gray-".basename($file_dir);
	grayjpg($file_dir, $grayimg);
	$detect_result = array();
	$detect_result[0] = choose_max(face_detect($grayimg, $xml[0]));
	for($i=1;$i<count($xml);$i++)
	{
		
		$detect_result[$i] = choose_max(selector($detect_result[0],face_detect($grayimg, $xml[$i])));
	}
	
	include "test.php";
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

function selector($face,$features)
{
	$temp = array();
	for ($i = 0,$j = 0; $i < count($features); $i++)
	{
		if ($features[$i]["x"]>=$face["x"]&&$features[$i]["y"]>=$face["y"]&&
		($features[$i]["x"]+$features[$i]["w"])<=($face["x"]+$face["w"])&&
		($features[$i]["y"]+$features[$i]["h"])<=($face["y"]+$face["h"]))
		{
			$temp[$j] = $features[$i];
			$j++;
			
		}
			
	}
	return $temp;
}

?>
