<?php
// return a similarity to compare

//include_once "xml.php";

function similarity($face1,$face2)
{
	// $temp1 = $face1.n1*$face2.n1+$face1.n2*$face2.n2+$face1.n3*$face2.n3+$face1.n4*$face2.n4;
	// $temp2 = sqrt($face1.n1^2+$face1.n2^2+$face1.n3^2+$face1.n4^2)*sqrt($face2.n1^2+$face2.n2^2+$face2.n3^2+$face2.n4^2);
	$temp1 = 0;
	$temp2 = 0;
	$temp3 = 0;
	$temp4 = 0;
	for($i = 0;$i<$face1->attr_count;$i++)
	{
		$temp1 += $face1->attribute[$i]*$face2->attribute[$i];
		$temp3 += pow($face1->attribute[$i],2);
		$temp4 += pow($face2->attribute[$i],2);
	}
	$temp2 = sqrt($temp3)*sqrt($temp4);
	$cos_sim = $temp1/$temp2;
	return $cos_sim;
}

?>
