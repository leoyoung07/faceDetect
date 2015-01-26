<?php
	function grayjpg($res,$grayimg,$face_x,$face_y,$face_w,$face_h)
	{
		// Load
		$img = imagecreatefromjpeg($res);
		$width = 200;
		$height = 200;	
		$thumb = imagecreatetruecolor($width,$height);

		// Resize
		imagecopyresized($thumb, $img, 0, 0, $face_x, $face_y, $width, $height, $face_w, $face_h);

		for($x=0;$x<$width;$x++)
		{
			for($y=0;$y<$height;$y++)
			{
				$rgb = ImageColorAt($thumb,$x,$y);
				$r = $rgb>>16 & 0xFF;
				$g = $rgb>>8 & 0xFF;
				$b = $rgb & 0xFF;
				$avg = (int)(($r+$g+$b)/0x3);
				//printf("%x ",$avg);
				$gray = ($avg<<16) + ($avg<<8) + $avg;
				//printf("%06x ",$gray);
				imagesetpixel($thumb, $x, $y, $gray);
			}
		}
		
		imagejpeg($thumb,$grayimg);
		imagedestroy($thumb);
		imagedestroy($img);
	}
/*	
	$res = 'img/Taylor/1.jpg';
	$grayimg = 'gray/1.jpg';
	grayjpg($res, $grayimg);
	echo <<<EOT
	<img src="{$grayimg}">

EOT;
*/
?>
