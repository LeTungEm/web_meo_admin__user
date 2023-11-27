<?php
include("../../function/function.php");

class Accounts extends Db
{

    public function authenticate($email, $password)
    {
        $sql = "SELECT * FROM `admin` WHERE `user_name` = ? and `pass` = ?";
        $data = $this->select($sql, array($email, $password));
        if (count($data) > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }
    
    public function insertAccount($user_name, $pass)
    {
        $sql = "INSERT INTO `admin`(`user_name`, `pass`, `salt`) VALUES (?,?,?)";
        $result = $this->insert($sql, array($user_name, $pass, '168'));
        if ($result['rowCount'] > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }

    public function updateAccount($user_name, $pass)
    {
        $sql = "UPDATE `admin` SET `user_name` = ?, `pass`= ?";
        $result = $this->update($sql, array($user_name, $pass));
        if ($result > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }
}
?>