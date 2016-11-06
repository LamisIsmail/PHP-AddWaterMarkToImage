watermark.php?filename=myimage.jpg
$filename=$_REQUEST['filename'];
//$imgpath is where images in this gallery reside $imgpath="images/";

$imgpath = $imgpath.$filename;

header('content-type: image/jpeg'); //HTTP header - All images in our gallery are JPGs

$watermarkfile="images/watermark.png";

$watermark = imagecreatefrompng($watermarkfile);
//Get the width and height of your watermark
list($watermark_width,$watermark_height) = getimagesize($watermarkfile);
//Now get the main gallery image (at $imgpath) so we can maniuplate it
$image = imagecreatefromjpeg($imgpath);
//Get the width and height of your image - we will use this to calculate where the watermark goes
$size = getimagesize($imgpath);
//Calculate where the watermark is positioned

$dest_x = $size[0] - $watermark_width - 15;
$dest_y = $size[1] - $watermark_height - 15;

//Please refere to documentation: http://www.php.net/manual/en/function.imagecopy.php
imagecopy($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height);
//Finalize the image:
imagejpeg($image);
//Destroy the image and the watermark handles
imagedestroy($image);
imagedestroy($watermark);