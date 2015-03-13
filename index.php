<?php 

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
				<a href="http://www.baidu.com" class="result_a">
					<div class="tile custom">
						<img src="img/Taylor/1.jpg" class="result_img">
						<div class="result_info" style="background-color:#aaaaaa;position:absolute;left:0;top:0;display:none;">
							123
						</div>
					</div>
				</a>

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
		
		

