<html>
<head>
<meta charset="utf-8">
</head>
<body>
<h1 style="text-align:center">Update Logs</h1>
<?php
$time = $_POST["time"];
$update = $_POST["update"];
$new = $_POST["new"];

$data = "时间:".$time."\n"."修改:".$update."\n"."新增:".$new."\n\n\n";
$file = "log.txt";
$data .= file_get_contents($file);
if($time==null && $update==null && $new==null)
{
}
else{
	$f = fopen($file,"w");
	fwrite($f,$data);
	fclose($f);
}
$data = str_replace("\n","<br>",$data);
echo $data;
?>
</body>
</html>
