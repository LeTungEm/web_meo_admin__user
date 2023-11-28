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
include('../Models/Setting.class.php');

$action = isset($_POST["action"]) ? $_POST["action"] : '';
$setting = new Setting();
$message = array();
switch ($action) {
    case "getAll":
        $message = $setting->getAll();
        break;
    case "updateClientRespons":
        $client_respons = $_POST["client_respons"];
        $message = $setting->updateClientRespons($client_respons);
        break;
    case "updateBanner":
        $banner = $_POST["banner"];
        $message = $setting->updateBanner($banner);
        break;
    case "updateAbout":
        $about = $_POST["about"];
        $message = $setting->updateAbout($about);
        break;
    case "updateService":
        $service = $_POST["service"];
        $message = $setting->updateService($service);
        break;
    case "updatePolicy":
        $policy = $_POST["policy"];
        $message = $setting->updatePolicy($policy);
        break;
    case "updateExperience":
        $experience = $_POST["experience"];
        $message = $setting->updateExperience($experience);
        break;
    case "updateMating":
        $mating = $_POST["mating"];
        $message = $setting->updateMating($mating);
        break;
    default:
        $message = "action is not found";
        break;

}

header('Content-Type: application/json; charset=utf-8');
// ob_clean();
echo json_encode($message, JSON_NUMERIC_CHECK);
?>