<?php
header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json;");
// header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type,
//     Access-Control-Allow-Headers, Authorization, X-Requested-With"); 
// header("Access-Control-Allow-Origin: http://localhost:8080");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include("../Config/config.php");
include('../Models/Db.class.php');
include('../Models/Rating.class.php');

$action = isset($_POST["action"]) ? $_POST["action"] : '';
$rating = new Rating();
$message = array();
switch ($action) {
    case "getByCatId":
        $cat_id = $_POST["cat_id"];
        $message = $rating->getByCatId($cat_id);
        break;
    case "deleteByCatID":
        $cat_id = $_POST["cat_id"];
        $message = $rating->deleteByCatID($cat_id);
        break;
    case "insertRating":
        $comment = $_POST["comment"];
        $user_name = $_POST["user_name"];
        $user_phone = $_POST["user_phone"];
        $star_number = $_POST["star_number"];
        $cat_id = $_POST["cat_id"];
        $message = $rating->insertRating($comment, $user_name, $user_phone, $star_number, $cat_id);
        break;
    default:
        $message = "action is not found";
        break;

}

header('Content-Type: application/json; charset=utf-8');
// ob_clean();
echo json_encode($message, JSON_NUMERIC_CHECK);
?>