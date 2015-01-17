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

	for($i=0;$i<count($xml);$i++)
	{
		$detect_result[$i] = face_detect($grayimg, $xml[$i]);
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


?>
