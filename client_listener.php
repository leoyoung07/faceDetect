
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
				
				
				
				$longitude = "";
				$latitude = "";
				include_once "similarity.php";
				include_once "face_class.php";
				include_once "xml.php";
				include_once "gray.php";
				function choose_max($features)
				{
					$result = array();
					$max = 0;
					for ($i = 0; $i < count($features); $i++)
					{
						if ($features[$i]["w"]*$features[$i]["h"]>$max)
						{
							$max = $features[$i]["w"]*$features[$i]["h"];
							$result = $features[$i];
						}
						
					}
					return $result;
					
				}
				// $features = array("face","right_eye","left_eye","nose","mouth");
				// $loc = array("x","y","w","h");
				$detect_result = array();
				$detect_result[0] = choose_max(face_detect($file_dir, $xml[0]));
				$grayimg = "gray/gray-".basename($file_dir);
				grayjpg($file_dir, $grayimg,$detect_result[0]["x"],$detect_result[0]["y"], $detect_result[0]["w"],$detect_result[0]["h"]);
				if($_POST["tag"] == "search")
				{
				



					$face1 = new face($grayimg);
					$sql = "select name,dir,location from user natural join pic;";
					$connect = connect();
					$result = $connect->query($sql);
					$result->setFetchMode(PDO::FETCH_ASSOC);
					$search_result = "";

					while ($array = $result->fetch())
					{
						$dir = $array["dir"];
						$face2 = new face("gray/gray-".basename($dir));
						$similarity = similarity($face1,$face2);
						$similarity = number_format($similarity*100,2);
						unset($face2);
						if((int)$similarity>=90)
						{
							break;
						}
					}

					unlink($grayimg);
					unlink($file_dir);
					$last_longitude = split("lo",$array["location"])[1];
					$last_longitude = (double)$last_longitude;
					$last_latitude = split("lo",$array["location"])[2];
					$last_latitude = (double)$last_longitude;
					$distance = get_distance($last_longitude,$last_latitude,$longitude,$latitude) * 1000;
					$content = "距离:".$distance."m,".split("lo",$array["location"])[3];;
					$urlf="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
					$po= strripos($urlf,'/');
					$url = substr($urlf,0,$po+1).$dir;
					$name = $array["name"];
					$result = array("name"=>$name, "url" => $url, "content"=>$content);
					echo json_encode($result);
				}
				else
				{
					$size = (int)($file["size"]/1024);
					$content = $file["name"]." is uploaded.";
					$location = "lo".$_POST["longitude"]."lo".$_POST["latitude"]."lo".$_POST["word"];
					$user_name = $_POST["name"];
					$sql = "select user_id from user where name='{$user_name}';";
					$connect = connect();
					$result = $connect->query($sql);
					$result->setFetchMode(PDO::FETCH_ASSOC);
					$array = $result->fetch();
					$user_id = $array["user_id"];
					$pic_columns = "user_id,dir,timestamp,location";
					$pic_values = "{$user_id},'{$file_dir}','{$timestamp}','{$location}'";

					$sql = "insert into pic({$pic_columns}) values ({$pic_values});";


					$result = $connect->exec($sql);
					if ($result==true)
					{
						//echo "sql successed<br>";
						$success = array("result"=>$content);
						echo json_encode($success);
						
					}	
					else
					{
						//echo "sql failed<br>";

					}
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

			$sql = "select name,dir,location from user natural join pic;";
			$connect = connect();
			$result = $connect->query($sql);
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$longitude = (double)$_POST["longitude"];
			$latitude = (double)$_POST["latitude"];			
			while($array = $result->fetch())
			{
				$last_longitude = split("lo",$array["location"])[1];
				$last_longitude = (double)$last_longitude;
				$last_latitude = split("lo",$array["location"])[2];
				$last_latitude = (double)$last_longitude;
				
				$distance = get_distance($last_longitude,$last_latitude,$longitude,$latitude) * 1000;

				if($distance<=2000)
				{
					$name = $array["name"];
					$content = "距离:".$distance."m,".split("lo",$array["location"])[3];
					$urlf="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
					$po= strripos($urlf,'/');
					$url = substr($urlf,0,$po+1)."upload/".basename($array["dir"]);
					$result = array("name"=>$name, "url" => $url, "content"=>$content);
					echo json_encode($result);
					break;

						
				}
			}
//		}
	}
}


?>
