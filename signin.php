<?php
include_once "connect.php";
$connect = connect();
$name = $_POST["username"];
$password = $_POST["password"];
$sql = "select * from user where name='{$name}' and password='{$password}';";
$result = $connect->query($sql);
$result->setFetchMode(PDO::FETCH_NUM);
$array = $result->fetch();
if($array)
{	
	session_start();
	$_SESSION['user']= $name;
	header("Location:index.php");
}
else
{
	echo <<<EOT
	<meta http-equiv="refresh" content="0;url=sign.php">
	<meta charset="utf-8">
	<script>alert('用户名或密码错误')</script>
EOT;
	//header("Location:index.php");
}
?>