<?php
//echo "test code: ".$_POST["test"]."\n";
//echo "test file: ".$_FILES["file"];
//var_dump($_REQUEST);
$string_img = $_POST["file"];
$file_name = $_POST["file_name"];
$img = imagecreatefromstring($string_img);
imagejpeg($img,$file_name);
// echo <<<EOT
	// <img src="1.jpg">
// EOT;
echo $file_name." is uploaded.";
?>