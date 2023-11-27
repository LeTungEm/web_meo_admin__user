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
include('../Models/Order.class.php');
include('../Models/MailSender.class.php');


$action = isset($_POST["action"]) ? $_POST["action"] : '';
$order = new Order();
$mailSender = new MailSender();
$message = array();
switch ($action) {
    case "getAll":
        $message = $order->getAll();
        break;
    case "getByID":
        $order_id = $_POST["order_id"];
        $message = $order->getByID($order_id);
        break;
    case "setIsView":
        $order_id = $_POST["order_id"];
        $message = $order->setIsView($order_id);
        break;
    case "insertOrder":
        $user_name = $_POST["user_name"];
        $user_phone = $_POST["user_phone"];
        $address = $_POST["address"];
        $total = $_POST["total"];
        $listCat = $_POST["listCat"];
        $message = $order->insertOrder($user_name, $user_phone, $address, $total);
        $mailSender->sendMail('DON HANG MOI TU WEBSITE', createHtml($user_name, $user_phone, $total, $listCat));
        break;
    default:
        $message = "action is not found";
        break;

}


function createHtml($user_name, $user_phone, $total, $listCat)
{
    $cats = json_decode($listCat);
    $catsHtml = '';
    foreach($cats as $value){
        $catsHtml .= "
            <div class='catItem'>
                <img class='image' src='".DOMAN."/back_end/api/Controllers/GetFileController.php?imgURL=".$value->image."' />
                <div class='ml'>
                    <div class='text-pink'>$value->name</div>
                    <div>".number_format($value->price, 0, ',', '.')."đ  x  ".$value->quantity."</div>
                </div>
            </div>
        ";
    }
    $data = "
    <!DOCTYPE html>
    <html lang=''>
    
    <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <meta name='viewport' content='width=device-width,initial-scale=1.0'>
      <style>
        .catItem{
            width: 100%;
            display: flex;
            align-item: center;
            justify-content: space-between;
            gap: 1.25rem;
            margin-bottom: 1.25rem;
            font-weight: 700;
        }
        .image{
            width: 30%;
        }
        .total{
            width: 100%;
            display: flex;
            align-item: center;
            justify-content: space-between;
            font-weight: 700;
            font-size: 1.5rem;
        }
        .ml{
            margin-left: 1.25rem;
        }
        .text-pink{
            color: #da8393;
        }
      </style>
    </head>
    
    <body>
        <h5>Tên khách hàng: $user_name</h5>
        <h5>Số điện thoại: $user_phone</h5>
        <div>
            $catsHtml
        </div>
        <div class='total'>
            <span>Tổng cộng:&nbsp;&nbsp;</span>
            <span>".number_format($total, 0, ',', '.')."đ</span>
        </div>
    </body>
    
    </html>
    ";
    return $data;
}

header('Content-Type: application/json; charset=utf-8');
// ob_clean();
echo json_encode($message, JSON_NUMERIC_CHECK);
?>