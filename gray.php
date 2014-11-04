<?php
	function grayjpg($res,$grayimg)
	{
		$img = imagecreatefromjpeg($res);
		$w = ImageSX($img);
		$h = ImageSY($img);

		for($x=0;$x<$w;$x++)
		{
			for($y=0;$y<$h;$y++)
			{
				$rgb = ImageColorAt($img,$x,$y);
				$r = $rgb>>16 & 0xFF;
				$g = $rgb>>8 & 0xFF;
				$b = $rgb & 0xFF;
				$avg = (int)(($r+$g+$b)/0x3);
				//printf("%x ",$avg);
				$gray = ($avg<<16) + ($avg<<8) + $avg;
				//printf("%06x ",$gray);
				imagesetpixel($img, $x, $y, $gray);
			}
		}

		imagejpeg($img,$grayimg);
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
