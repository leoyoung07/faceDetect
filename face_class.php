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
	public function __construct($face_loc,$rightEye_loc,$leftEye_loc,$nose_loc,$mouth_loc)
	{
		$this->attribute = array();
		$this->attribute[0] = sqrt(pow($rightEye_loc["x"]-$face_loc["x"],2)+pow($rightEye_loc["y"]-$face_loc["y"],2));
		$this->attribute[1] = sqrt(pow($leftEye_loc["x"]-$face_loc["x"],2)+pow($leftEye_loc["y"]-$face_loc["y"],2));
		$this->attribute[2] = sqrt(pow($nose_loc["x"]-$face_loc["x"],2)+pow($nose_loc["y"]-$face_loc["y"],2));
		$this->attribute[3] = sqrt(pow($mouth_loc["x"]-$face_loc["x"],2)+pow($mouth_loc["y"]-$face_loc["y"],2));
		$this->attr_count = count($this->attribute);
	}
}
?>