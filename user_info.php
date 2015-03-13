<?php
if(!isset($_SESSION))
{
	session_start();
}
if(!isset($_SESSION['user_name'])||$_SESSION['user_name']=="findu_anonymous_user")
{
	echo <<<EOT
	<meta http-equiv="refresh" content="0;url=sign.php">
	<meta charset="utf-8">
	<script>alert('请先登录')</script>
EOT;
exit();
}

$content = <<<EOT
	<!-- =========================	User Info	========================= -->	
		<div class="">
			<fieldset>
			<legend>我的信息</legend>
				<p>我的信息</p>
			</fieldset>
		</div>
EOT;
$active_page = "user_info_page";
$script = "";
$style = "";
include "template.php";

?>