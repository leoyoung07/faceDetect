<?php
function get_rad($degree)
{
	$rad = M_PI * $degree / 180.0;
	return $rad;
}
/*
function get_distance($longitude1, $latitude1, $longitude2, $latitude2)
{
	$dr = 111;
	$dx = $dr * abs($longitude2 - $longitude1) * cos(get_rad($latitude1));
	$dy = $dr * abs($latitude2 - $latitude1);
	$ds = sqrt(pow($dx,2)+pow($dy,2));
	return $ds;
}
*/




function get_distance($lng1, $lat1, $lng2, $lat2)
{
$EARTH_RADIUS = 6378.137;
$radLat1 = get_rad($lat1);
$radLat2 = get_rad($lat2);
$a = $radLat1 - $radLat2;
$b = get_rad($lng1) - get_rad($lng2);
$s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));
$s = $s * $EARTH_RADIUS;
//$s = Math.Round(s * 10000) / 10000;
return $s;
}
?>
