<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$files = isset($_FILES["files"]) ? $_FILES["files"] : '';
$imageNames = isset($_POST["names"]) ? $_POST["names"] : '';
$path = '../../uploads/';
$newName = '';
foreach ($files['tmp_name'] as $index => $tmp_name) {
    $tmp = $tmp_name;
    $compressionRatio = 0.9;
    $imageName = $imageNames[$index];
    $newName = substr($imageName, 0, strrpos($imageName, '.'));
    $name = $newName . '.jpg';
    if ($files['size'][$index] > 1000000*3) {
        $name = $newName . '_delete_.jpg';
    }
    $saveName = $newName . '.jpg';
    if (move_uploaded_file($tmp, $path . $name)) {
        if ($files['size'][$index] > 1000000*3){
            $image = imagecreatefromjpeg($path . $name);
            imagejpeg($image, $path . $saveName, $compressionRatio);
            imagedestroy($image);
            unlink($path . $name);
        }
        echo json_encode(['message' => true]);
    } else {
        echo json_encode(['message' => false]);
    }
}

?>