<?php
class face
{
	// private $face;
	// private $rightEye;
	// private $leftEye;
	// private $nose;
	// private $mouth;
	public $attribute;
	public $attr_count;
	public $grayimg;
	public function __construct($grayimg)
	{
		$res = imagecreatefromjpeg($grayimg);
		$width = imagesx($res);
		$height = imagesy($res);
		$this->attribute = array();
		$this->grayimg = $grayimg;
		for ($x = 0,$i = 0; $x < $width; $x++)
		{
			for($y = 0; $y < $height; $y++)
			{
				$rgb = ImageColorAt($res,$x,$y);
				$this->attribute[$i] = $rgb & 0xFF;
				$i++;
			}
			
		}
		$this->attr_count = count($this->attribute);
		imagedestroy($res);
	}
	/*
	public function __construct($face_loc,$rightEye_loc,$leftEye_loc,$nose_loc,$mouth_loc)
	{
		$length = sqrt(pow($face_loc["w"],2)+pow($face_loc["h"],2));
		$this->attribute = array();
		$this->attribute[0] = sqrt(pow($rightEye_loc["x"]-$face_loc["x"],2)+pow($rightEye_loc["y"]-$face_loc["y"],2))/$length;
		$this->attribute[1] = sqrt(pow($leftEye_loc["x"]-$face_loc["x"],2)+pow($leftEye_loc["y"]-$face_loc["y"],2))/$length;
		$this->attribute[2] = sqrt(pow($nose_loc["x"]-$face_loc["x"],2)+pow($nose_loc["y"]-$face_loc["y"],2))/$length;
		$this->attribute[3] = sqrt(pow($mouth_loc["x"]-$face_loc["x"],2)+pow($mouth_loc["y"]-$face_loc["y"],2))/$length;
		$this->attr_count = count($this->attribute);
	}
	*/
}
?>
