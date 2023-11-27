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
include('../Models/Accounts.class.php');

$action = isset($_POST["action"]) ? $_POST["action"] : '';
$Accounts = new Accounts();
$message = array();
switch ($action) {
    case "authenticate":
        $email = $_POST["email"];
        $password = $_POST["password"];
        $message = $Accounts->authenticate($email, $password);
        break;
    case "insertAccount":
        $user_name = $_POST["user_name"];
        $pass = $_POST["pass"];
        $message = $Accounts->insertAccount($user_name, $pass);
        break;
    case "updateAccount":
        $pass = $_POST["pass"];
        $message = $Accounts->updateAccount($pass);
        break;
    default:
        $message = "action is not found";
        break;

}

header('Content-Type: application/json; charset=utf-8');
// ob_clean();
echo json_encode($message, JSON_NUMERIC_CHECK);
?>