<?php
// return a serial to compare


//$file = "img/Taylor/3.jpg";//原文件
//$face_xml = "./xml/haarcascade_lefteye_2splits.xml";//XML文件

function face_compare($row){
	$image = imagecreatefromjpeg ($row[0]);//创建文件
	$backgroundcolor = ImageColorAllocate($image, 255, 0, 0);//矩形颜色
	//绘制矩形
for($x=1;$x<=count($row)-4;$x+=4)
{
//	$dr = face_detect($file, $face_xml);//返回矩形参数x,y,w,h
//	if ($dr)
//	{
//		foreach ($dr as $dr1)
//		{
	$x;
	$y = $x+1;
	$w = $x+2;
	$h = $x+3;
			imagerectangle($image,$row[$x],$row[$y],
			$row[$x]+$row[$w],$row[$y]+$row[$h],
			$backgroundcolor);
//		}
//	}
}
//	$time=time();
	$hash_name = sha1($row[0]);
	if(file_exists("./analyze/")==false)
	{
		mkdir("./analyze/");
	}
	$newfile="./analyze/{$hash_name}.jpg";//新文件名
	imagejpeg($image,$newfile);//生成新文件
	return $newfile; 
}

function face_serial()
{
	$serial = 123;

	echo "serial: ".$serial;
	
	return $serial;
}

?>
