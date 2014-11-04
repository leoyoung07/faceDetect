<?php
$host = "localhost";
$user = "root";
$password = "1";
$connect = mysql_connect($host,$user,$password);
mysql_select_db("pictures",$connect);
mysql_query("set names utf8",$connect);
?>
