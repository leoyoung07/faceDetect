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

include_once "connect.php";
$connect = connect();
$script = "";

if(isset($_POST["changed"]))
{
	$sql = "update user set person_name='{$_POST["person_name"]}',tel='{$_POST["tel"]}',email='{$_POST["email"]}' where name='{$_SESSION["user_name"]}';";
	$exec = $connect->exec($sql);
	if($exec == true)
	{
		$script = <<<EOT
alert('保存成功');
EOT;
	}
	else
	{
		$script = <<<EOT
alert('保存失败');
EOT;
	}
}


$sql = "select * from user where name='{$_SESSION["user_name"]}';";

$result = $connect->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$array = $result->fetch();
$person_name = $array["person_name"];
$tel = $array["tel"];
$email = $array["email"];

$content = <<<EOT
	<!-- =========================	User Info	========================= -->	
		<div class="">
			<fieldset>
			<legend>我的信息</legend>
<form class="form-horizontal" action="user_info.php" method="post">
	<!-- =========================	Information	========================= -->
	<input type="hidden" name="changed" value="yes">
	<div class="control-group">
		<label class="control-label" for="user_name">用户名: </label>
		<div class="controls">
			<p class="lead" id="user_name">{$_SESSION["user_name"]}</p>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="person_name">姓名: </label>
		<div class="controls">
			<input name="person_name" type="text" id="person_name" placeholder="请输入姓名" value="{$person_name}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="tel">电话: </label>
		<div class="controls">
			<input name="tel" type="text" id="tel" placeholder="请输入联系电话" value="{$tel}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="email">邮箱: </label>
		<div class="controls">
			<input name="email" type="text" id="email" placeholder="请输入邮箱" value="{$email}">
		</div>
	</div>	

	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-primary">保存</button>
		</div>
	</div>
</form>
</form>
			</fieldset>
		</div>
EOT;
$active_page = "user_info_page";
$style = "";
include "template.php";

?>