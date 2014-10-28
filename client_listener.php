
<?php
include_once "get_distance.php";
//file upload
$longitude = "";
$latitude = "";

$last_longitude = 121.52245;
$last_latitude = 38.87985;

$longitude = (double)$_POST["longitude"];
$latitude = (double)$_POST["latitude"];

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
		
		
		$size = (int)($file["size"]/1024);
		$distance = get_distance($last_longitude,$last_latitude,$longitude,$latitude) * 1000;
		echo $file["name"]." is uploaded \n size: ".(int)($file["size"]/1024)."kb\nlongitude:{$longitude}\nlatitude:{$latitude}\ndistance:{$distance}m";

		//include "analyze.php";

//test codes
/*
		include_once "gray.php";
		$grayimg = 'gray/'.sha1($file_dir).'.jpg';
		grayjpg($file_dir, $grayimg);
		include "test.php";
		include_once "xml.php";
		$locs = array(' F',' LE',' Re',' N',' M');
		foreach($locs as $key=>$loc)
		{
			$newfile = face_compare($grayimg,$xml[$key],$loc);
			echo <<<EOT
				<img src="{$newfile}"><br>
EOT;

		}
		echo <<<EOT
			<form action="analyze.php" method="post">
			<input type="hidden" name="file_dir" value="{$file_dir}">
			<input type="submit" value="analyze">
			</form>
EOT;
*/
//test codes
	}
}
else
{
	echo "invalid file!";
}




?>
