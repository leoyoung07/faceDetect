<?php
include_once "connect.php";
//include "xml.php";
include_once "gray.php";

include_once "serial.php";

include_once "face_compare.php";

//$res = 'img/Taylor/1.jpg';
$grayimg = 'gray/'.sha1($file_dir).'.jpg';
grayjpg($file_dir, $grayimg);
echo <<<EOT
	<img src="{$grayimg}">
EOT;
$serial = face_serial();
$dir = face_compare($serial);
include "insert.php";
include "display.php";
//$file=$_POST["file"];


?>
