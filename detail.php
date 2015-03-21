<?php 
include_once "connect.php";
include_once "session.php";
$dir = $_GET["dir"];

$connect = connect();
$sql = "select * from pic where dir='{$dir}';";
$result = $connect->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$array = $result->fetch();
$location = $array["location"];
$user_id = $array["user_id"];
$timestamp = $array["timestamp"];
$sql = "select name,tel,email,person_name from user where user_id={$user_id};";
$result = $connect->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$array = $result->fetch();
if($_SESSION['user_name']=="findu_anonymous_user")
{
	$person_name = "请登录后查看";
	$tel = "请登录后查看";
	$email = "请登录后查看";
}
else
{
	$person_name = $array["person_name"];
	$tel = $array["tel"];
	$email = $array["email"];
}
date_default_timezone_set("Asia/Shanghai"); 
//echo <<<EOT
//<script>alert('{$timestamp}')</script>
//EOT;
$date = date("Y年m月d日 H点i分",$timestamp);
$detail = <<<EOT
<div class="">

		<div class="">
			<pre class="lead">
			<img src="{$dir}" class="img-rounded result_img" style="float:left;">		
			<strong>
				上传信息:
			</strong>
				上传者姓名: <span class="lead">{$person_name}</span>
				
				上传者电话: <span class="lead">{$tel}</span>
				
				上传者邮箱: <span class="lead">{$email}</span>
				
				其他信息: <span class="lead">{$location}</span>
			</pre>	

		</div>
</div>
EOT;


$content = <<<EOT
		
	<!-- =========================	Detail	========================= -->	
		<div class="">
			<fieldset>
			<legend>详细信息</legend>
				{$detail}
			</fieldset>
		</div>
EOT;

$active_page = "";
$script = <<<EOT
		$(".result_a").mouseenter(function()
		{
			$(this).children().children(".result_info").css("display","inline");
		});
		$(".result_a").mouseleave(function()
		{
			$(this).children().children(".result_info").css("display","none");
		});
EOT;
$style = "";
include "template.php";
?>		
		
		

