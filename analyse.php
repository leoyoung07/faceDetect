<?php
include_once "session.php";

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
	$similarity_req = (int)$_POST["similarity"];
	if($similarity_req>100||$similarity_req<0)
	{
		echo <<<EOT
<meta http-equiv="refresh" content="0;url=index.php">
<meta charset="utf-8">
<script>alert('请输入有效的相似度')</script>
EOT;
		exit();
	}
	$face1 = new face($grayimg);
	$sql = "select * from pic;";
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
		if((int)$similarity>=$similarity_req)
		{
			$search_result .= <<<EOT
<a href="detail.php?dir={$dir}" class="result_a">
	<div class="tile custom">
		<img src="{$dir}" class="result_img">
		<div class="result_info" style="background-color:#aaaaaa;position:absolute;left:0;top:0;display:none;">
			相似度: {$similarity}%
		</div>
	</div>
</a>
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
	$content = <<<EOT
	<!-- =========================	Search	========================= -->

		<fieldset>
		<legend>图片搜索</legend>
			<div class="text-center">
				<form class="form-inline" action="upload_handler.php" method="post" enctype="multipart/form-data">
				<input type="hidden" name="type" value="search">
				<div class="">
				<span class="">选择文件:</span>
				<input class="" type="file" name="file" id="file">
				<div class="input-prepend input-append">
		          <span class="add-on">相似度</span>
		          <input class="span2" id="similarity" name="similarity" type="text" value="90">
		          <span class="add-on">%</span>
		        </div>			
				<button type="submit" name="submit" id="submit" class="btn btn-primary">搜索</button>
				</div>
				</form>
			</div>
		</fieldset>
				
	<!-- =========================	Content	========================= -->	
		<div class="">
			<fieldset>
			<legend>搜索结果</legend>
			{$search_result}
			</fieldset>
		</div>
EOT;
	$active_page = "index_page";
	$script = <<<EOT
			$(".result_a").mouseenter(function()
			{
				$(this).children().children(".result_info").css("display","inline");
			});
			$(".result_a").mouseleave(function()
			{
				$(this).children().children(".result_info").css("display","none");
			});
EOT;
	$style = "";
	include "template.php";
}
else
{
	$size = (int)($file["size"]/1024);
	$content = $file["name"]." is uploaded <br> size: ".(int)($file["size"]/1024)."kb<br>";
	$location = $_POST["location"];
	$user_name = $_SESSION['user_name'];
	$sql = "select user_id from user where name='{$user_name}';";
	$connect = connect();
	$result = $connect->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$array = $result->fetch();
	$user_id = $array["user_id"];
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



