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
	<!-- =========================	Content	========================= 
		<div class="">
			<fieldset>
			<legend>找找看</legend>
				<a href="http://www.baidu.com"><div class="tile double double-vertical bg-custom"><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p></div></a>
				<a href="http://www.baidu.com"><div class="tile bg-cyan"><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p></div></a>
				<a href="http://www.baidu.com"><div class="tile ol-cyan"><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p></div></a>
				<a href="http://www.baidu.com"><div class="tile"><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p></div></a>
			</fieldset>
		</div>
	-->		
		
		
	</div>
</div>
    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/tile.js"></script>
	<script>
	$(document).ready(function()
	{
		$("#file_upload_page").attr("class","active");
	});
	</script>
</body>
</html>
