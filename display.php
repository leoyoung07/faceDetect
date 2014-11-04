<?php
/*
$sql = "select dir,fx,fy,fw,fh,leyex,leyey,leyew,leyeh,reyex,reyey,reyew,reyeh,nosex,nosey,nosew,noseh,mouthx,mouthy,mouthw,mouthh from face_info;";
$result = mysql_query($sql,$connect);
while($row = mysql_fetch_row($result))
{
//	print_r($row);

	$newfile = face_compare($row);
	echo "<img src=\"{$newfile}\">"."<br>";//输出文件
}
*/
$file_to_display = $_POST["file_to_display"];
echo $file_to_display;//输出文件
?>

