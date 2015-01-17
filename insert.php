
<?php
include_once "connect.php";
include_once "xml.php";

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
