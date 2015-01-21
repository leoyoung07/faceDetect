<?php
include_once "connect.php";
$connect = connect();
$name = $_POST["username"];
$password = $_POST["password"];
$sql = "insert into user(name,password) values ('{$name}','{$password}');";
$result = $connect->exec($sql);
if($result == true)
{
	session_start();
	$_SESSION['user']= $name;
	header("Location:user_info.php");
}
else
{
	echo <<<EOT
	<meta http-equiv="refresh" content="0;url=sign.php">
	<meta charset="utf-8">
	<script>alert('注册失败')</script>
EOT;
}
?>