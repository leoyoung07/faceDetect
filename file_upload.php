<?php 
$content = <<<EOT
<form class="" action="upload_handler.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="type" value="upload">
	<!-- =========================	Information	========================= -->
		<div class="text-left">
			<fieldset>
			<legend>相关信息</legend>
				
				<div class="offset1">

				<input class="" type="text"><br>
				<input class="" type="text"><br>
				<input class="" type="text"><br>
				<span class="">位置: </span><input name="location" class="" type="text"><br>
				</div>
			</fieldset>
		</div>		
	
	
	
	<!-- =========================	Upload	========================= -->
		<div class="">
			<fieldset>
			<legend>图片上传</legend>
				<div class="form-inline offset1">
				<span class="">选择文件:</span>
				<input class="" type="file" name="file" id="file">		
				<button type="submit" name="submit" id="submit" class="btn btn-primary ">上传</button>
				
				</div>
				
			</fieldset>
		</div>
		<br>
		<div class="">
		
		</div>
</form>		
EOT;


$active_page = "file_upload_page";
$script = "";
$style = "";
include "template.php";
?>
