
<?php
include_once "connect.php";
include_once "xml.php";

$pic_columns = "user_id,dir,timestamp,location";
$pic_values = "{$user_id},'{$file_dir}','{$timestamp}','{$location}'";

$sql = "insert into pic({$pic_columns}) values ({$pic_values});";

$connect = connect();
$result = $connect->exec($sql);
if ($result==true)
{
	//echo "sql successed<br>";
	echo <<<EOT
	<meta http-equiv="refresh" content="0;url=file_upload.php">
	<meta charset="utf-8">
	<script>alert('上传成功')</script>
EOT;
	
}	
else
{
	//echo "sql failed<br>";
	echo <<<EOT
	<meta http-equiv="refresh" content="0;url=file_upload.php">
	<meta charset="utf-8">
	<script>alert('上传失败,请重试')</script>
EOT;
}




/*
$features = array("face","left_eye","right_eye","nose","mouth");
$loc = array("x","y","w","h");
$field="dir";
//for($i=0;$i<count($features);$i++)
//{
	for($j=0;$j<count($loc);$j++)
	{
		$field.=",".$loc[$j];
	}
//}



$sql = array();
for($i=0,$n=0;$i<count($features);$i++)
{
	for($j=0;$j<count($detect_result[$i]);$j++)
	{
		$value = "'{$file_dir}'";
		for($k=0;$k<count($loc);$k++)
		{
			$temp = $detect_result[$i][$j][$loc[$k]];
			//var_dump($array[$k]);
			//echo "<br>";
			if($temp==null)
			{
				$temp=-1;
			}
			$value.=",{$temp}";	
		}
		//echo $n." ";
		$sql[$n] = "insert into {$features[$i]}({$field}) values ({$value});";
		$n++;
	//echo "<br>";
	}
}
*/



?>
