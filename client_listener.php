
<?php
include_once "get_distance.php";
include_once "connect.php";
$connect = connect();
if(isset($_POST["action"]))
{
	//登陆注册
	$action = $_POST["action"];
	$name = $_POST["name"];
	$pw = $_POST["pwd"];
	$success = array("state"=>1);
	$fail = array("state"=>0);
	if($action == "up")
	{
		$sql = "select * from user where name='{$name}';";
		$result = $connect->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$array = $result->fetch();
		
		if($array)
		{
			echo "id exists";
		}
		else
		{
			$sql = "insert into user(name,password) values('{$name}','{$pw}');";
			$state = $connect->exec($sql);
			if($state == true)
			{
				echo json_encode($success);
			}
			else
			{
				echo json_encode($fail);
			}
		}
	}
	else
	{
		$sql = "select * from user where name='{$name}' and password='{$pw}';";
		$result = $connect->query($sql);
		$result->setFetchMode(PDO::FETCH_ASSOC);
		$array = $result->fetch();
		if($array)
		{
			echo json_encode($success);
		}
		else
		{
			//echo json_encode($fail);
		}
	}
}
else
{

	if(isset($_FILES["file"]))
	{
		//文件上传
		$file=$_FILES["file"];
		//$check_file = ($file["type"]=="image/jpeg"||$file["type"]=="image/png"||$file["type"]=="image/bmp"||$file["type"]=="image/pjpeg")&&($file["size"]<2000000);
		$check_file= true;
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
				$timestamp = time();
				$file_dir = "./upload/".$timestamp."-".rand().".jpg";
				move_uploaded_file($file["tmp_name"],$file_dir);
				if($_POST["word"]=="又")
				{
					echo 1;
				}
				else
				{
					echo 0;
				}
				
				//$size = (int)($file["size"]/1024);
				//$distance = get_distance($last_longitude,$last_latitude,$longitude,$latitude) * 1000;
				//echo $file["name"]." is uploaded \n size: ".(int)($file["size"]/1024)."kb\nlongitude:{$longitude}\nlatitude:{$latitude}\ndistance:{$distance}m";

			}
		}
		else
		{
			echo "invalid file!";
		}
	}
	else
	{
		//经纬度测距
		$longitude = "";
		$latitude = "";

		$last_longitude = 121.52245;
		$last_latitude = 38.87985;

		$longitude = (double)$_POST["longitude"];
		$latitude = (double)$_POST["latitude"];
		$distance = get_distance($last_longitude,$last_latitude,$longitude,$latitude) * 1000;
		echo "longitude:{$longitude}\nlatitude:{$latitude}\ndistance:{$distance}m";
	}
}


?>
