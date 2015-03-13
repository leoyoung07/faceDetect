<?php
if(!isset($_SESSION))
{
	session_start();
}
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
	<?php echo $style;?>

	</style>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">

	    <!-- =========================	Navbar	========================= -->
		<div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
			<div class="container">
			  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			  <a class="brand" href="./index.php">Find U</a>
			  <div class="nav-collapse collapse">
				<ul class="nav text-center">
				  <li id="index_page" class="">
					<a href="./index.php">首页</a>
				  </li>
				  <li id="file_upload_page" class="">
					<a href="./file_upload.php">上传</a>
				  </li>
				  <li id="about_page" class="">
					<a href="./about.php">联系我们</a>
				  </li>		
				</ul>
				<ul class="nav text-center pull-right">
<?php
if($_SESSION['user_name']=="findu_anonymous_user")
{
	echo <<<EOT
				  <li id="sign_page" class="">
					<a href="./sign.php">登录/注册</a>
				  </li>
EOT;
}
else
{
	echo <<<EOT
				  <li id="user_info_page" class="">
					<a href="./user_info.php">{$_SESSION['user_name']}</a>
				  </li>
				  <li id="logout_page" class="">
					<a href="./sign.php">退出</a>
				  </li>
EOT;
}
?>


				</ul>
			  </div>
			</div>
		  </div>
		</div>

	    <!-- =========================	Header	========================= -->		
	<div class="jumbotron masthead">
	  <div class="container">
		<h1>Find U</h1>
		<p>简单高效的人脸搜索平台。</p>
	  </div>
	</div>	
	    <!-- =========================	Content	========================= -->	
<div class="container">
	<div class="row-fluid">

	<?php echo $content;?>
	
	</div>
</div>

	    <!-- =========================	Script	========================= -->	
    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/tile.js"></script>
	
	<script>
	$(document).ready(function()
	{
		$("#<?php echo $active_page;?>").attr("class","active");
		<?php echo $script;?>
	});
	</script>
</body>
</html>

