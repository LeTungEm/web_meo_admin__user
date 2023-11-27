<?php
class OrderDetail extends Db
{
    public function getAllByOrderId($order_id)
    {
        $sql = "SELECT `cat`.name, `order_detail`.price, `order_detail`.quantity, `cat`.image FROM `order_detail` INNER JOIN `cat` ON `cat`.cat_id = `order_detail`.cat_id WHERE `order_id` = ?";
        return $this->select($sql, array($order_id));
    }
    
    public function deleteByCatID($cat_id)
    {
        $sql = "DELETE FROM `order_detail` WHERE `cat_id` = ?";
        $result = $this->delete($sql, array($cat_id));
        if ($result['rowCount'] > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }

    public function insertOrderDetail($order_id, $listDetail)
    {
        $orderDetail = json_decode($listDetail);
        $arrValueForm = array();
        $arrValue = array();
        foreach ($orderDetail as $value) {
            $arrValue[] = $order_id;
            $arrValue[] = $value->quantity;
            $arrValue[] = $value->price;
            $arrValue[] = $value->cat_id;
            $arrValueForm[] = '(?,?,?,?)';
        }
        $sql = "INSERT INTO `order_detail`(`order_id`, `quantity`, `price`, `cat_id`) VALUES ". implode(", ", $arrValueForm) . ';';
        $result = $this->insert($sql, $arrValue);
        if ($result['rowCount'] > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }

}
?>