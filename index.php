<?php 
include_once "connect.php";
$sql = "select top 9 from pic order by timestamp desc;";
$connect = connect();
$result = $connect->query($sql);
// $result->setFetchMode(PDO::FETCH_ASSOC);
 $search_result = "";
// while ($array = $result->fetch())
// {
	// $dir = $array["dir"];
	// $search_result .= <<<EOT
// <a href="http://www.baidu.com" class="result_a">
	// <div class="tile custom">
		// <img src="{$dir}" class="result_img">
		// <div class="result_info" style="background-color:#aaaaaa;position:absolute;left:0;top:0;display:none;">
			// time: {$array["timestamp"]}
		// </div>
	// </div>
// </a>
// EOT;
//}

$content = <<<EOT
	

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
		
	<!-- =========================	Result	========================= -->	
		<div class="">
			<fieldset>
			<legend>随便找找</legend>
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
?>		
		
		

