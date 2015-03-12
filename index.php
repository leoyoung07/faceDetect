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
		
		
		
	</div>
</div>
    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/tile.js"></script>
	<script>
	$(document).ready(function()
	{
		$("#index_page").attr("class","active");
		$(".result_a").mouseenter(function()
		{
			$(this).children().children(".result_info").css("display","inline");
		});
		$(".result_a").mouseleave(function()
		{
			$(this).children().children(".result_info").css("display","none");
		});
	});
	</script>
</body>
</html>
