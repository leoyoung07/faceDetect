<?php
$type = trim($_POST["type"]);
if($type=="in")
{
	include "signin.php";
}
else
{
	include "signup.php";
}
?>