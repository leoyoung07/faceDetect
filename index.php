<?php 
include_once "connect.php";
$sql = "select * from pic order by timestamp desc limit 9;";
$connect = connect();
$result = $connect->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$search_result = "";
while ($array = $result->fetch())
{
	$dir = $array["dir"];
	$timestamp = $array["timestamp"];
	$date = date("Y年m月d日 H点i分",$timestamp);
	$search_result .= <<<EOT
<a href="detail.php?dir={$dir}" class="result_a">
	<div class="tile custom">
		<img src="{$dir}" class="result_img">
		<div class="result_info" style="background-color:#aaaaaa;position:absolute;left:0;top:0;display:none;">
			上传时间: {$date}
		</div>
	</div>
</a>
EOT;
}

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
				<div class="input-prepend input-append">
		          <span class="add-on">相似度</span>
		          <input class="span2" id="similarity" name="similarity" type="text" value="90">
		          <span class="add-on">%</span>
		        </div>			
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
		
		

