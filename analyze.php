<?php
include_once "connect.php";
//include "xml.php";
include_once "gray.php";
$file_dir = $_POST["file_dir"];





$grayimg = 'gray/'.sha1($file_dir).'.jpg';
grayjpg($file_dir, $grayimg);

/*
echo <<<EOT
	<img src="{$grayimg}">
EOT;
*/

include "serial.php";
//include "insert.php";

include_once "face_compare.php";
$serials = 123;
$dirs = face_compare($serials);
$file = "";
for ($i = 0; $i < count($dirs); $i++)
{
	$file .= "<img src='".$dirs[$i]."'><br>";
	
}


echo <<<EOT
	<form action="display.php" method="post">
	<input type="hidden" name="file_to_display" value="{$file}">
	<input type="submit" value="display">
	</form>
	
EOT;



?>
