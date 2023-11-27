<?php

class Order extends Db
{
    public function getAll()
    {
        $sql = "SELECT * from `order` ORDER BY order_id DESC";
        return $this->select($sql);
    }
    public function getByID($order_id)
    {
        $sql = "SELECT * from `order` WHERE order_id = ?";
        $data = $this->select($sql, array($order_id));
        if (count($data) > 0) {
            return $data[0];
        } else {
            return null;
        }
    }
    
    public function setIsView($order_id)
    {
        $sql = "UPDATE `order` SET `isView`= 1 WHERE `order_id` = ?";
        return $this->select($sql, array($order_id));
    }

    public function insertOrder($user_name, $user_phone, $address, $total)
    {
        $sql = "INSERT INTO `order`(`user_name`, `user_phone`, `address`, `total`) VALUES (?, ?, ?, ?)";
        $result = $this->insert($sql, array($user_name, $user_phone, $address, $total));
        if ($result['rowCount'] > 0) {
            return ['message' => true, 'order_id' => $result['lastInsertId']];
        } else {
            return ['message' => false, 'order_id' => $result['lastInsertId']];
        }
    }

}
?>