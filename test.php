<?php
//$file = "img/Taylor/3.jpg";//原文件
//$face_xml = "./xml/haarcascade_lefteye_2splits.xml";//XML文件
function face_compare($file,$dr1,$loc){

	$image = imagecreatefromjpeg ($file);//创建文件
	$backgroundcolor = ImageColorAllocate($image, 255, 0, 0);//矩形颜色
	//绘制矩形
//foreach($xml as $face_xml)	
//	if ($dr)
//	{
//		$i=0;
	//$dr = face_detect($file, $face_xml);//返回矩形参数x,y,w,h	
	//print_r($dr);
//		foreach ($dr as $dr1)
//		{
			imagerectangle($image,$dr1["x"],$dr1["y"],
			$dr1["x"]+$dr1["w"],$dr1["y"]+$dr1["h"],
			$backgroundcolor);

			imagestring($image,3,$dr1["x"],$dr1["y"],$loc,$backgroundcolor);
//			$i++;
//		}
//	}
	$time=time();
	$rand=rand();
	if(file_exists("./analyse/")==false)
	{
		mkdir("./analyse/");
	}
	$newfile="./analyse/{$time}-{$rand}.jpg";//新文件名
	imagejpeg($image,$newfile);//生成新文件
	return $newfile; 
}
//echo "<img src=\"{$newfile}\">";//输出文件
?>

<html>
<body>
<form action="client_listener.php" method="post">
<input type="text" name="name" placeholder="name"><br>
<input type="text" name="pwd" placeholder="pwd"><br>
<input type="text" name="email" placeholder="email"><br>
<input type="text" name="action" placeholder="action"><br>
<input type="submit" value="测试">
</form>
</body>
</html>


