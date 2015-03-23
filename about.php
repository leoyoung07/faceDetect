<?php
$content = <<<EOT
	<!-- =========================	About	========================= -->	
		<div class="">
			<fieldset>
			<legend>关于我们</legend>
				<p class="lead"><strong>Find U制作团队</strong></p>
				<p>我们是来自大连理工大学的学生团队，团队成员为<strong>杨韬、于振泽</strong>。</p>
				<address>
				  <strong>联系方式</strong><br>
				  <strong>杨韬:</strong><abbr title="E-mail">420760135@qq.com</abbr> <br>
				  <strong>于振泽:</strong><abbr title="E-mail">849236714@qq.com</abbr> <br>
				</address>
				<address>
				  <strong>地址</strong><br>
				  大连理工大学  <br>
				  地址：中国·辽宁省大连市甘井子区凌工路2号  邮编：116024<br>
				</address>
			</fieldset>
		</div>

EOT;
$active_page = "about_page";
$script = "";
$style = "";
include "template.php";
?>
