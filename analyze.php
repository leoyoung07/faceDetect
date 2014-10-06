<?php
include_once "connect.php";
//include "xml.php";
include_once "display.php";
//$file=$_POST["file"];
/*
include "demo.php";
$xml ="xml/haarcascade_lefteye_2splits.xml";
$img=face_compare($file,$xml);
echo "</div><div><img src=\"{$img}\"></div></body>";


$f = face_detect($file, "xml/haarcascade_frontalface_alt_tree.xml");
$loc = array("x","y","w","h");
$array = array();
for($i=0;$i<4;$i++)
{
	$array[$i] = $f[0][$loc[$i]];
}
$value = "'{$file}'";
for($i=0;$i<count($array);$i++)
{
	$value.=",{$array[$i]}";
}
echo $value;

$sql = "insert into face_info(dir,fx,fy,fw,fh) values ($value);";
*/
$sql = "select dir,fx,fy,fw,fh,leyex,leyey,leyew,leyeh,reyex,reyey,reyew,reyeh,nosex,nosey,nosew,noseh,mouthx,mouthy,mouthw,mouthh from face_info;";
$result = mysql_query($sql,$connect);
while($row = mysql_fetch_row($result))
{
//	print_r($row);

	$newfile = face_compare($row);
	echo "<img src=\"{$newfile}\">"."<br>";//输出文件
}

//var_dump($f);
//print_r($array);


?>
