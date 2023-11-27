<?php
class Category extends Db
{
    public function getAll()
    {
        $sql = "SELECT * from category";
        return $this->select($sql);
    }

}
?>