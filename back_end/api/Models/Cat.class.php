<?php
class Cat extends Db
{
    public function getAll()
    {
        $sql = "SELECT `cat_id`, cat.`name`, cat.`slug`, `age`, `price`, `new_price`, `gender`, `color`, `status`, `dewormmed`, `origin`, `father`, `mother`, `health`, `vaccination`, `characteristic`, cat.`description`, `isShow`, `image`, `video`, cat.`category_id`, category.name as category_name, category.slug as category_slug from cat inner join category on cat.category_id = category.category_id where isShow = 1";
        return $this->select($sql);
    }
    public function getAllCat()
    {
        $sql = "SELECT `cat_id`, cat.`name`, cat.`slug`, `age`, `price`, `new_price`, `gender`, `color`, `status`, `dewormmed`, `origin`, `father`, `mother`, `health`, `vaccination`, `characteristic`, cat.`description`, `isShow`, `image`, `video`, cat.`category_id`, category.name as category_name, category.slug as category_slug from cat inner join category on cat.category_id = category.category_id ORDER BY cat_id DESC";
        return $this->select($sql);
    }
    public function getBySlug($slug)
    {
        $sql = "SELECT `cat_id`, cat.`name`, cat.`slug`, `age`, `price`, `new_price`, `gender`, `color`, `status`, `dewormmed`, `origin`, `father`, `mother`, `health`, `vaccination`, `characteristic`, cat.`description`, `isShow`, `image`, `video`, cat.`category_id`, category.name as category_name, category.slug as category_slug from cat inner join category on cat.category_id = category.category_id where cat.slug = ?";
        $data = $this->select($sql, array($slug));
        if (count($data) > 0) {
            return $data[0];
        } else {
            return null;
        }
    }
    public function changeIsShow($cat_id, $isShow)
    {
        $sql = "UPDATE `cat` SET `isShow`= ? WHERE `cat_id` = ?";
        $result = $this->update($sql, array($isShow, $cat_id));
        if ($result['rowCount'] > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }
    public function deleteCat($cat_id, $listImage)
    {
        $sql = "DELETE FROM `cat` WHERE `cat_id` = ?";
        $result = $this->delete($sql, array($cat_id));
        $isDeleteAllImage = $this->deleteImage($listImage);
        if ($result['rowCount'] > 0) {
            return ['message' => true, 'isDeleteAllImage' => $isDeleteAllImage];
        } else {
            return ['message' => false, 'isDeleteAllImage' => $isDeleteAllImage];
        }
    }
    public function deleteImage($listImage)
    {
        $imageArr = json_decode($listImage);
        $countImageDeleted = 0;
        $path = '../../uploads/';
        if (count($imageArr) > 0) {
            foreach ($imageArr as $imageName) {
                $imageLink = $path.$imageName;
                if (file_exists($imageLink)) {
                    if (unlink($imageLink)) {
                        $countImageDeleted++;
                    }
                }
            }
            if($countImageDeleted == count($imageArr)){
                return true;
            }else{
                return false;
            }
        }
    }

    public function searchCat($search)
    {
        $search = "'%" . $search . "%'";
        $sql = "SELECT `cat_id`, cat.`name`, cat.`slug`, `age`, `price`, `new_price`, `gender`, `color`, `status`, `dewormmed`, `origin`, `father`, `mother`, `health`, `vaccination`, `characteristic`, cat.`description`, `isShow`, `image`, `video`, cat.`category_id`, category.name as category_name, category.slug as category_slug from cat inner join category on cat.category_id = category.category_id where cat.name like " . $search . " or category.name like " . $search;
        return $this->select($sql);
    }
    public function insertCat($name, $slug, $age, $price, $new_price, $gender, $color, $status, $dewormmed, $origin, $father, $mother, $health, $vaccination, $characteristic, $description, $isShow, $image, $video, $category_id)
    {
        $sql = "INSERT INTO `cat`(`name`, `slug`, `age`, `price`, `new_price`, `gender`, `color`, `status`, `dewormmed`, `origin`, `father`, `mother`, `health`, `vaccination`, `characteristic`, `description`, `isShow`, `image`, `video`, `category_id`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $result = $this->insert($sql, array($name, $slug, $age, $price, $new_price, $gender, $color, $status, $dewormmed, $origin, $father, $mother, $health, $vaccination, $characteristic, $description, $isShow, $image, $video, $category_id));
        if ($result['rowCount'] > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }
    public function updateCat($name, $slug, $age, $price, $new_price, $gender, $color, $status, $dewormmed, $origin, $father, $mother, $health, $vaccination, $characteristic, $description, $isShow, $image, $video, $category_id, $cat_id)
    {
        $sql = "UPDATE `cat` SET `name`= ?,`slug`= ?,`age`= ?,`price`= ?,`new_price`= ?,`gender`= ?,`color`= ?,`status`= ?,`dewormmed`= ?,`origin`= ?,`father`= ?,`mother`= ?,`health`= ?,`vaccination`= ?,`characteristic`= ?,`description`= ?,`isShow`= ?,`image`= ?,`video`= ?,`category_id`= ? WHERE `cat_id` = ?";
        $result = $this->update($sql, array($name, $slug, $age, $price, $new_price, $gender, $color, $status, $dewormmed, $origin, $father, $mother, $health, $vaccination, $characteristic, $description, $isShow, $image, $video, $category_id, $cat_id));
        if ($result['rowCount'] > 0) {
            return ['message' => true];
        } else {
            return ['message' => false];
        }
    }

}
?>