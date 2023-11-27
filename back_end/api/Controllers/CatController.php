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
include('../Models/Cat.class.php');

$action = isset($_POST["action"]) ? $_POST["action"] : '';
$cat = new Cat();
$message = array();
switch ($action) {
    case "getAll":
        $message = $cat->getAll();
        break;
    case "getAllCat":
        $message = $cat->getAllCat();
        break;
    case "getBySlug":
        $slug = $_POST["slug"];
        $message = $cat->getBySlug($slug);
        break;
    case "changeIsShow":
        $cat_id = $_POST["cat_id"];
        $isShow = $_POST["isShow"];
        $message = $cat->changeIsShow($cat_id, $isShow);
        break;
    case "deleteCat":
        $cat_id = $_POST["cat_id"];
        $listImage = $_POST["listImage"];
        $message = $cat->deleteCat($cat_id, $listImage);
        break;
    case "searchCat":
        $search = $_POST["search"];
        $message = $cat->searchCat($search);
        break;
    case "deleteImage":
        $listImage = $_POST["listImage"];
        $message = $cat->deleteImage($listImage);
        break;
    case "insertCat":
        $name = $_POST["name"];
        $slug = $_POST["slug"];
        $age = $_POST["age"];
        $price = $_POST["price"];
        $new_price = $_POST["new_price"];
        $gender = $_POST["gender"];
        $color = $_POST["color"];
        $status = $_POST["status"];
        $dewormmed = $_POST["dewormmed"];
        $origin = $_POST["origin"];
        $father = $_POST["father"];
        $mother = $_POST["mother"];
        $health = $_POST["health"];
        $vaccination = $_POST["vaccination"];
        $characteristic = $_POST["characteristic"];
        $description = $_POST["description"];
        $isShow = $_POST["isShow"];
        $image = $_POST["image"];
        $video = $_POST["video"];
        $category_id = $_POST["category_id"];
        $message = $cat->insertCat($name, $slug, $age, $price, $new_price, $gender, $color, $status, $dewormmed, $origin, $father, $mother, $health, $vaccination, $characteristic, $description, $isShow, $image, $video, $category_id);
        break;
    case "updateCat":
        $name = $_POST["name"];
        $slug = $_POST["slug"];
        $age = $_POST["age"];
        $price = $_POST["price"];
        $new_price = $_POST["new_price"];
        $gender = $_POST["gender"];
        $color = $_POST["color"];
        $status = $_POST["status"];
        $dewormmed = $_POST["dewormmed"];
        $origin = $_POST["origin"];
        $father = $_POST["father"];
        $mother = $_POST["mother"];
        $health = $_POST["health"];
        $vaccination = $_POST["vaccination"];
        $characteristic = $_POST["characteristic"];
        $description = $_POST["description"];
        $isShow = $_POST["isShow"];
        $image = $_POST["image"];
        $video = $_POST["video"];
        $category_id = $_POST["category_id"];
        $cat_id = $_POST["cat_id"];
        $message = $cat->updateCat($name, $slug, $age, $price, $new_price, $gender, $color, $status, $dewormmed, $origin, $father, $mother, $health, $vaccination, $characteristic, $description, $isShow, $image, $video, $category_id, $cat_id);
        break;
    default:
        $message = "action is not found";
        break;

}

header('Content-Type: application/json; charset=utf-8');
// ob_clean();
echo json_encode($message, JSON_NUMERIC_CHECK);
?>