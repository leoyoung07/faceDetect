<!DOCTYPE HTML>
<html>
<head><meta charset="gb2312"></head>
<body>
<?php
//file upload
$file=$_FILES["file"];
$check_file = ($file["type"]=="image/jpeg"||$file["type"]=="image/png"||$file["type"]=="image/bmp"||$file["type"]=="image/pjpeg")&&($file["size"]<2000000);
if($check_file)
{
	if($file["error"]>0)
	{
		echo "error: ".$file["error"];
	}
	else
	{
		if(file_exists("upload")==false)
		{
			mkdir("upload");
		}

		$file_dir = "./upload/".time().rand().".jpg";
		move_uploaded_file($file["tmp_name"],$file_dir);

		echo $file["name"]." is uploaded <br> size: ".(int)($file["size"]/1024)."kb";
		echo "<br>";
		
		sleep(3);

		include "analyze.php";

//test codes
/*
		include "test.php";
		include_once "xml.php";
		$locs = array(' F',' LE',' Re',' N',' M');
		foreach($locs as $key=>$loc)
		{
			$newfile = face_compare($grayimg,$xml[$key],$loc);
			echo <<<EOT
				<img src="{$newfile}">
EOT;
		}
		
*/
//test codes
	}
}
else
{
	echo "invalid file!";
}

/*
echo <<<EOT
	<form action="analyze.php" method="post">
	<input type="hidden" name="file" value="{$file_dir}">
	<input type="submit" value="analyze">
	</form>
	
EOT;
*/
?>
</body>
</html>
