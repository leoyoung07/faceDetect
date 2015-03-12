<?php
session_start();

$_SESSION['user_name']="findu_anonymous_user";

?>
<!doctype html>
<html>
<head>
	<title>Find U</title>
	<meta charset="utf-8">

	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	
	<link href="css/findu.css" rel="stylesheet">
	<style>
	*{margin:0;padding: 0;}
      body{background: #444}
      .loginBox{width:520px;height:270px;padding:0 20px;border:1px solid #fff; color:#000; margin-top:40px; border-radius:8px;background: white;box-shadow:0 0 15px #222; background: -moz-linear-gradient(top, #fff, #efefef 8%);background: -webkit-gradient(linear, 0 0, 0 100%, from(#f6f6f6), to(#f4f4f4));font:11px/1.5em 'Microsoft YaHei' ;position: absolute;left:50%;top:45%;margin-left:-270px;margin-top:-115px;}
      .loginBox h2{height:45px;font-size:20px;font-weight:normal;}
      .loginBox .left{border-right:1px solid #ccc;height:100%;padding-right: 20px; }
	  .loginBox .right{solid #ccc;height:100%;padding-right: 20px; }
	</style>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">

	<?php
	include "navbar.php";
	include "head.php";
	?>
    <div class="container-fluid">


	
	<!-- =========================	LoginBox	========================= -->	
        <section class="loginBox row-fluid">
          <section class="span6 left">
		  <form action="sign_handler.php" method="post">
            <h2>用户登录</h2>
			<section>
			<input type="hidden" name="type" value="in">
            <p><input type="text" name="username" placeholder="用户名" ></p>
            <p><input type="password" name="password" placeholder="密码" ></p>
            <p><label><input type="checkbox" name="rememberme" >下次自动登录</label></p>
			</section>
		  <br>		
		  <section class="span8"></section>	 
          <section class="span1"><input type="submit" value=" 登录 " class="btn btn-primary"></section>
            </form>
          </section>
          <section class="span6 right">
		  <form action="sign_handler.php" method="post">
            <h2>没有帐户？</h2>
            <section>
			<input type="hidden" name="type" value="up">
            <p><input type="text" name="username" placeholder="用户名" ></p>
            <p><input type="password" name="password" placeholder="密码" ></p>
			<p><input type="password" name="passwordAg" placeholder="确认密码" ></p>
			</section>
			<section class="span8"></section>
            <section class="span1"><input type="submit" value=" 注册 " class="btn"></section>
			</form>
		  </section>
        </section>
    </div>
    <script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script>
	$(document).ready(function()
	{
		$("#sign_page").attr("class","active");
	});
	</script>
  </body>
</html>
</html>
