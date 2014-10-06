
<?php
include_once "connect.php";
include_once "xml.php";
//$file_dir=$_POST["file"];
/*
include "demo.php";
$xml ="xml/haarcascade_lefteye_2splits.xml";
$img=face_compare($file,$xml);
echo "</div><div><img src=\"{$img}\"></div></body>";
*/


//$file_dir = "./upload/3.jpg";



$detect_result = array();

for($i=0;$i<count($xml);$i++)
{
	$detect_result[$i] = face_detect($grayimg, $xml[$i]);
}

/*
$f[6] = face_detect($file_dir, $xml[6]);
var_dump(face_detect($file_dir, $xml[4]));
$f[0] = face_detect($file_dir, $xml[0]);
$f[0] = face_detect($file_dir, $xml[0]);
$f[0] = face_detect($file_dir, $xml[0]);
$f[0] = face_detect($file_dir, $xml[0]);
$f[0] = face_detect($file_dir, $xml[0]);
*/


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


//$array = array();
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

//echo "<br>";
//print_r($sql);

/*
$value = "'{$file_dir}'";
for($i=0;$i<count($array);$i++)
{
	$value.=",{$array[$i]}";
}
*/
//echo $value."<br>";

//echo $t;
//echo "<br>";
//dir,fx,fy,fw,fh,leyex,leyey,leyew,leyeh,reyex,reyey,reyew,reyeh,nosex,nosey,nosew,noseh,mouthx,mouthy,mouthw,mouthh

//$sql = "insert into face_info({$field}) values ({$value});";
for($i=0;$i<count($sql);$i++)
{
	mysql_query($sql[$i],$connect);
}

//var_dump($f);
//print_r($array);

?>
