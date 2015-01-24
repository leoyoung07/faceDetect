
<?php
include_once "connect.php";
include_once "xml.php";

$pic_columns = "user_id,dir,timestamp,location";
$pic_values = "{$user_id},'{$file_dir}','{$timestamp}','{$location}'";
$face_columns = "pic_dir";
for ($i = 0; $i < count($features); $i++)
{
	for ($j = 0; $j < count($loc); $j++)
	{
		$face_columns.= ",{$features[$i]}_{$loc[$j]}";
	}
	
}
$face_values = "'{$file_dir}'";
for ($i = 0; $i < count($detect_result); $i++)
{
	for ($j = 0; $j < count($loc); $j++)
	{
		$face_values.= ",{$detect_result[$i][$loc[$j]]}";
	}
	
}
$sql = array();
$sql[0] = "insert into pic({$pic_columns}) values ({$pic_values});";
$sql[1] = "insert into face({$face_columns}) values ({$face_values});";

for ($i = 0; $i < count($sql); $i++)
{
	echo $sql[$i]."<br>";
	
}

$connect = connect();
for ($i = 0; $i < count($sql); $i++)
{
	$result = $connect->exec($sql[$i]);
	if ($result==true)
	{
		echo "sql".$i." successed<br>";
		
	}	
	else
	{
		echo "sql".$i." failed<br>";
	}
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
