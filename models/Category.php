<?php

class Category extends Database
{

    public $db;

    public function __construct($host, $user, $pass, $db)
    {
        parent::__construct($host, $user, $pass, $db);
    }

    public function get_all(){

        $sql = "SELECT `id`, `name` FROM `categories`";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return False;
        }

        for($i = 0; $i < mysqli_num_rows($res); $i++){
            $row[] = mysqli_fetch_assoc($res);
        }

        return $row;
    }

    public function get_one($id){

        $sql = "SELECT `id`, `name` FROM `categories` WHERE `id`= '" . $id . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return 'Проблема с подключением к базе данных';
        }

        $row = mysqli_fetch_assoc($res);

        return $row;
    }

    public function check_category($category){

        $sql = "SELECT `name` FROM `categories` WHERE `name`= '" . $category . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return 'Проблема с подключением к базе данных';
        }

        $row = mysqli_fetch_assoc($res);

//        print_r($row);

        if($row['name'] == $category){
            return 'Такая категория уже существует';
        }
        else return TRUE;
    }

    public function save($category){

        $str = "'" . $category . "'";

        $sql = 'INSERT INTO `categories` (`name`) VALUES ('. $str .')';

        mysqli_query($this->db, $sql);

        if(mysqli_insert_id($this->db) == 0){

            return 'Возникла ошибка во время сохранения';
        }

        return mysqli_insert_id($this->db);
    }

    public function change($id, $name){

        $sql = "UPDATE `categories` SET `name`='". $name ."' WHERE `id` = '" . $id . "'";

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

        $sql = "DELETE FROM `categories` WHERE `id` = '" . $id . "'";

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