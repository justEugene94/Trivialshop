<?php

class Good extends Database{

    public function __construct($host, $user, $pass, $db)
    {
        parent::__construct($host, $user, $pass, $db);
    }

    public function get_all(){

        $sql = "SELECT `id`, `name`, `text`, `price`, `img` FROM `goods`";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return False;
        }

        for($i = 0; $i < mysqli_num_rows($res); $i++){
            $row[] = mysqli_fetch_assoc($res);
        }

        return $row;
    }

    public function get_for_category($id){

        $sql = "SELECT g.`id`, `name`, `text`, `price`, `img` FROM `goods` g JOIN `category_good` c ON g.`id`=c.`good_id` WHERE `category_id` = " . $id;

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return False;
        }

        for($i = 0; $i < mysqli_num_rows($res); $i++){
            $row[] = mysqli_fetch_assoc($res);
        }

        return $row;
    }

    public function get_product($id){
        $sql = "SELECT `id`, `name`, `text`, `price`, `img` FROM `goods` WHERE `id` = " . $id;

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return False;
        }

        $row = mysqli_fetch_assoc($res);

        return $row;
    }

    public function save($arr){

        $str = "'" . $arr['name'] . "', '" . $arr['text'] . "', '" . $arr['price'] . "', '" . $arr['img'] . "'";

        $sql = 'INSERT INTO `goods` (`name`, `text`, `price`, `img`) VALUES ('. $str .')';

        mysqli_query($this->db, $sql);

        if(mysqli_insert_id($this->db) == 0){

            return 'Возникла ошибка во время сохранения';
        }

        return mysqli_insert_id($this->db);
    }

    public function change($id, $arr){

        $sql = "UPDATE `goods` SET `name`= '". $arr['name'] ."', `text`= '". $arr['text'] ."', `price`= ". $arr['price'] .", `img`= '". $arr['img'] ."' WHERE `id` = '" . $id . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return 'Проблема с подключением к базе данных';
        }

        if(mysqli_affected_rows($this->db) <= 0){
            return FALSE;
        }

        return TRUE;
    }

    public function delete($id){

        $sql = "DELETE FROM `goods` WHERE `id` = '" . $id . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return 'Проблема с подключением к базе данных';
        }

        if(mysqli_affected_rows($this->db) <= 0){
            return FALSE;
        }

        return TRUE;
    }

}
?>