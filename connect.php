<?php
////用mysql函数库连接数据库
// $host = "localhost";
// $user = "root";
// $password = "";
// $connect = mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);
// mysql_select_db(SAE_MYSQL_DB,$connect);
// mysql_query("set names utf8;",$connect);

//用PDO方式连接数据库
function connect()
{
	// $dsn = 'mysql:dbname='.SAE_MYSQL_DB.';host='.SAE_MYSQL_HOST_M.';port='.SAE_MYSQL_PORT;
	// $user = SAE_MYSQL_USER;
	// $pw = SAE_MYSQL_PASS;
	$dsn = 'mysql:dbname='.'findu'.';host='.'localhost'.';port='.'3306';
	$user = 'root';
	$pw = '';
	try
	{
		$connect = new PDO($dsn,$user,$pw);
		$connect->exec("set names utf8;");
		return $connect;
	}
	catch(PDOException $ex)
	{
		echo $ex->getMessage();
	}
}

?>
