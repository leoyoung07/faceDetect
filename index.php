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
	
	    <!-- =========================	Navbar	========================= -->
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
			<div class="container-fluid">
			  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="brand" href="./index.php">Find U</a>
			  <div class="nav-collapse collapse">
				<ul class="nav text-center">
				  <li class="active">
					<a href="./index.php">首页</a>
				  </li>
				  <li class="">
					<a href="./file_upload.php">上传</a>
				  </li>
				  <li class="">
					<a href="./user_info.php">我的信息</a>
				  </li>
				  <li class="">
					<a href="./sign.php">登录/注册</a>
				  </li>
				  <li class="">
					<a href="./about.php">联系我们</a>
				  </li>
				</ul>
			  </div>
			</div>
		  </div>
		</div>
	
	<!-- =========================	Head	========================= -->
		<div>
			<br>
			<br>
			<h1 class="text-center">Find U</h1>
		</div>
	
	<!-- =========================	Search/Upload	========================= -->
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
				<a href="http://www.baidu.com"><div class="tile double double-vertical bg-custom"><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p></div></a>
				<a href="http://www.baidu.com"><div class="tile bg-cyan"><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p></div></a>
				<a href="http://www.baidu.com"><div class="tile ol-cyan"><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p></div></a>
				<a href="http://www.baidu.com"><div class="tile"><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p><p>123</p></div></a>
			</fieldset>
		</div>
		
		
		
	</div>
</div>
    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/tile.js"></script>
</body>
</html>
