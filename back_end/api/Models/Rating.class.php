<?php
class Rating extends Db
{
    public function getByCatId($rate_id)
    {
        $sql = "SELECT * from `rate` WHERE cat_id = ? ORDER BY rate_id DESC";
        return $this->select($sql, array($rate_id));
    }
    public function deleteByCatID($cat_id)
    {
        $sql = "DELETE FROM `rate` WHERE `cat_id` = ?";
        $result = $this->delete($sql, array($cat_id));
        if ($result['rowCount'] > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }

    public function insertRating($comment, $user_name, $user_phone, $star_number, $cat_id)
    {
        echo $comment . ' ' . $user_name . ' ' . $user_phone . ' ' . $star_number . ' ' . $cat_id;
        $sql = "INSERT INTO `rate`(`comment`, `user_name`, `user_phone`, `star_number`, `cat_id`) VALUES (?, ?, ?, ?, ?)";
        $result = $this->insert($sql, array($comment, $user_name, $user_phone, $star_number, $cat_id));
        if ($result['rowCount'] > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }

}
?>