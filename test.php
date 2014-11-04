<?php
//$file = "img/Taylor/3.jpg";//原文件
//$face_xml = "./xml/haarcascade_lefteye_2splits.xml";//XML文件
function face_compare($file,$face_xml,$loc){

	$image = imagecreatefromjpeg ($file);//创建文件
echo	$backgroundcolor = ImageColorAllocate($image, 255, 0, 0);//矩形颜色
	//绘制矩形
//foreach($xml as $face_xml)	
//	if ($dr)
//	{
		$i=0;
	$dr = face_detect($file, $face_xml);//返回矩形参数x,y,w,h	
	print_r($dr);
		foreach ($dr as $dr1)
		{
			imagerectangle($image,$dr1["x"],$dr1["y"],
			$dr1["x"]+$dr1["w"],$dr1["y"]+$dr1["h"],
			$backgroundcolor);

			imagestring($image,3,$dr1["x"],$dr1["y"],$loc."_".$i,$backgroundcolor);
			$i++;
		}
//	}
	$time=time();
	$rand=rand();
	if(file_exists("./analyze/")==false)
	{
		mkdir("./analyze/");
	}
	$newfile="./analyze/{$time}{$rand}.jpg";//新文件名
	imagejpeg($image,$newfile);//生成新文件
	return $newfile; 
}
//echo "<img src=\"{$newfile}\">";//输出文件
?>


