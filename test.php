<?php
ini_set('error_reporting', E_ALL);
header ("Content-type: image/jpeg");
$im = @imagecreatetruecolor(120, 20)
      or die("Cannot Initialize new GD image stream");
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 1, 5, 5,  "A Simple Text String", $text_color);
if (imagejpeg($im)) {echo "dale"; else "no";};
imagedestroy($im);
?>
