<?php
session_start();
if(!isset($_SESSION['user_name']))
{
	$_SESSION['user_name']="findu_anonymous_user";
}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Find U</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/tile.css" rel="stylesheet">
	<link href="css/findu.css" rel="stylesheet">
	<style>


	</style>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">


	<?php
	include "navbar.php";
	include "head.php";
	?>

<div class="container-fluid">
	<div class="row-fluid">
	

	<!-- =========================	Search	========================= -->
		<div class="text-center">
			<fieldset>
			<legend>图片搜索</legend>
				<form class="form-inline" action="upload_handler.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="type" value="search">
				<div class="">
				<span class="">选择文件:</span>
				<input class="" type="file" name="file" id="file">
				<button type="submit" name="submit" id="submit" class="btn btn-primary">搜索</button>
				</div>
				</form>
			</fieldset>
		</div>
				
	<!-- =========================	Content	========================= -->	
		<div class="">
			<fieldset>
			<legend>找找看</legend>

<?php
include_once "connect.php";
include_once "similarity.php";
include_once "face_class.php";
include_once "xml.php";
include_once "gray.php";
$features = array("face","right_eye","left_eye","nose","mouth");
$loc = array("x","y","w","h");
$detect_result = array();
$detect_result[0] = choose_max(face_detect($file_dir, $xml[0]));
$grayimg = "gray/gray-".basename($file_dir);
grayjpg($file_dir, $grayimg,$detect_result[0]["x"],$detect_result[0]["y"], $detect_result[0]["w"],$detect_result[0]["h"]);
/*
echo <<<EOT
	<br><img src="{$grayimg}"><br>
EOT;

for($i=1;$i<count($xml);$i++)
{
	
	$detect_result[$i] = choose_max(selector($detect_result[0],face_detect($grayimg, $xml[$i]),$features[$i]));
}
*/

$type = $_POST["type"];

if($type=="search")
{

	$face1 = new face($grayimg);
	$sql = "select * from pic;";
	$connect = connect();
	$result = $connect->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	
	while ($array = $result->fetch())
	{
		$dir = $array["dir"];
		$face2 = new face("gray/gray-".basename($dir));
		$similarity = similarity($face1,$face2);
		unset($face2);
		if($similarity>=0.9)
		{
			echo <<<EOT
		<a href="http://www.baidu.com"><div class="tile double double-vertical ol-cyan"><img src="{$dir}"><br>similarity: {$similarity}</div></a>
EOT;
		}
	}

//test codes
/*
	//var_dump($detect_result);
	include_once "test.php";
	foreach ($detect_result as $key => $value)
	{
		$test_pic = face_compare($grayimg,$value,$features[$key]);
		echo <<<EOT
		<img src="{$test_pic}">
EOT;
		echo "<br>";
	}

*/
	unlink($grayimg);
	unlink($file_dir);
}
else
{
	$size = (int)($file["size"]/1024);
	echo $file["name"]." is uploaded <br> size: ".(int)($file["size"]/1024)."kb<br>";
	$location = $_POST["location"];
	include_once "insert.php";
}



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

function selector($face,$features,$type)
{
	$temp = array();
	for ($i = 0,$j = 0; $i < count($features); $i++)
	{
		//选出人脸范围内的五官
		if ($features[$i]["x"]>=$face["x"]&&$features[$i]["y"]>=$face["y"]&&
		($features[$i]["x"])<=($face["x"]+$face["w"])&&
		($features[$i]["y"])<=($face["y"]+$face["h"]))
		{
			//选出正确位置的右眼
			if ($type=="right_eye")
			{
				if ($features[$i]["y"]<=($face["y"]+$face["y"]+$face["h"])/2&&
				$features[$i]["x"]<=($face["x"]+$face["x"]+$face["w"])/2)
				{
					$temp[$j] = $features[$i];
					$j++;
				}
			//选出正确位置的左眼
			}else if ($type=="left_eye")
			{
				if ($features[$i]["y"]<=($face["y"]+$face["y"]+$face["h"])/2&&
				$features[$i]["x"]>=($face["x"]+$face["x"]+$face["w"])/2&&
				$features[$i]["x"]<=($face["x"]+$face["w"]))
				{
					$temp[$j] = $features[$i];
					$j++;
				}
			//选出正确位置的嘴
			}else if ($type=="mouth")
			{
				if ($features[$i]["y"]>=($face["y"]+$face["y"]+$face["h"])/2&&
				$features[$i]["y"]<=($face["y"]+$face["h"])&&
				$features[$i]["x"]<=($face["x"]+$face["w"]))
				{
					$temp[$j] = $features[$i];
					$j++;			
				}
			//选出正确位置的鼻子	
			}else
			{
				if ($features[$i]["y"]<=($face["y"]+$face["h"])&&
				$features[$i]["x"]<=($face["x"]+$face["w"]))
				{
					$temp[$j] = $features[$i];
					$j++;			
				}
			}

			
		}
			
	}
	if (count($temp)==0)
	{
		$temp[0] = array("x"=>-1,"y"=>-1,"w"=>-1,"h"=>-1);
		
	}
	return $temp;
}

?>


			</fieldset>
		</div>
		
		
		
	</div>
</div>
    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/tile.js"></script>
	<!--
	<script>
	$(document).ready(function()
	{
		$("#index_page").attr("class","active");
	});
	</script>
	-->
</body>
</html>
