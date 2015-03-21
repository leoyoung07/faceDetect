<?php 
include_once "session.php";

include_once "connect.php";
$connect = connect();
if($_SESSION["user_name"]=="findu_anonymous_user")
{
	$person_name = "匿名";
	$tel = "无";
	$email = "无";
}
else
{
	$sql = "select * from user where name='{$_SESSION["user_name"]}';";

	$result = $connect->query($sql);
	$result->setFetchMode(PDO::FETCH_ASSOC);
	$array = $result->fetch();
	$person_name = $array["person_name"];
	$tel = $array["tel"];
	$email = $array["email"];
}

$content = <<<EOT
<form class="form-horizontal" action="upload_handler.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="type" value="upload">
	<!-- =========================	Information	========================= -->
		<div class="text-left">
			<fieldset>
			<legend>相关信息</legend>
				
	<div class="control-group">
		<label class="control-label" for="person_name">姓名: </label>
		<div class="controls">
			<p class="lead" id="person_name">{$person_name}</p>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="tel">电话: </label>
		<div class="controls">
			<p class="lead" id="tel">{$tel}</p>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="email">邮箱: </label>
		<div class="controls">
			<p class="lead" id="email">{$email}</p>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="location">拍照地点: </label>
		<div class="controls">
			<input name="location" type="text" id="location" placeholder="请输入拍照地点" value="">
		</div>
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
