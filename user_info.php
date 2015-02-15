<!DOCTYPE HTML>
<html>
<head>
	<title>Find U</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/tile.css" rel="stylesheet">
	<style>
body{font-family:"ff-tisa-web-pro-1","ff-tisa-web-pro-2","Lucida Grande","Helvetica Neue",Helvetica,Arial,"Hiragino Sans GB","Hiragino Sans GB W3","Microsoft YaHei UI","Microsoft YaHei","WenQuanYi Micro Hei",sans-serif;}

	</style>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<?php
session_start();
if(!isset($_SESSION['user']))
{
	$_SESSION['user']='anonymous_user';
}
?>



<div class="container-fluid">
	<div class="row-fluid">
	
	<?php
	include "navbar.php";
	include "head.php";
	?>
	

	<!-- =========================	User Info	========================= -->	
		<div class="">
			<fieldset>
			<legend>我的信息</legend>
				<p>我的信息</p>
			</fieldset>
		</div>
		
	<!-- =========================	Search/Upload	========================= 
		<div class="text-center">
			<fieldset>
			<legend>图片搜索</legend>
				<form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
				<div class="">
				<span class="">选择文件:</span>
				<input class="" type="file" name="file" id="file">
				<button type="submit" name="submit" id="submit" class="btn btn-primary">搜索</button>
				</div>
				</form>
			</fieldset>
		</div>
	-->	
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
		$("#user_info_page").attr("class","active");
	});
	</script>
</body>
</html>
