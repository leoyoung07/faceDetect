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
			  <div class="nav-collapse collapse"  style="float:right;">
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
	
