<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
require("../../image-master/src/Intervention/Image/Exception/ImageException.php");
require("../../image-master/src/Intervention/Image/Exception/NotSupportedException.php");
require("../../image-master/src/Intervention/Image/AbstractDriver.php");
require("../../image-master/src/Intervention/Image/Gd/Driver.php");
require("../../image-master/src/Intervention/Image/AbstractDecoder.php");
require("../../image-master/src/Intervention/Image/Gd/Decoder.php");
require("../../image-master/src/Intervention/Image/AbstractEncoder.php");
require("../../image-master/src/Intervention/Image/Gd/Encoder.php");
require("../../image-master/src/Intervention/Image/File.php");
require("../../image-master/src/Intervention/Image/Image.php");
require("../../image-master/src/Intervention/Image/Commands/AbstractCommand.php");
require("../../image-master/src/Intervention/Image/Commands/Argument.php");
require("../../image-master/src/Intervention/Image/Gd/Commands/ResizeCommand.php");
require("../../image-master/src/Intervention/Image/Gd/Commands/GetSizeCommand.php");
require("../../image-master/src/Intervention/Image/Size.php");
require("../../image-master/src/Intervention/Image/Point.php");
require("../../image-master/src/Intervention/Image/Constraint.php");
require("../../image-master/src/Intervention/Image/Commands/ResponseCommand.php");
require("../../image-master/src/Intervention/Image/Response.php");
require("../../image-master/src/Intervention/Image/ImageManagerStatic.php");
require("../../image-master/src/Intervention/Image/ImageManager.php");


$imgURL = isset($_GET["imgURL"]) ? $_GET["imgURL"] : '';
$width = isset($_GET["width"]) ? $_GET["width"] : '';
$message = array();
if ($imgURL == '') {
    $imgURL = 'default.jpg';
}
$path = '../../uploads/';
$filePath = $path . $imgURL;
if (!file_exists($filePath)) {
    $filePath = $path . 'default.jpg';
}
use Intervention\Image\ImageManagerStatic;

// Khởi tạo Intervention ImageManager
ImageManagerStatic::configure(['driver' => 'gd']);
$image = ImageManagerStatic::make($filePath);
$imageWidth = $image->width();
if ($imageWidth <= $width) {
    $width = $imageWidth;
}

// Chỉnh kích thước (ví dụ, giảm kích thước xuống 300px theo chiều rộng)
$image->resize($width, null, function ($constraint) {
    $constraint->aspectRatio();
});

header('Content-Type: image/jpeg');
// Xuất hình ảnh về client
echo $image->response('jpg', 80);
?>