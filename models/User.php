<?php

class User extends Database
{

    public function __construct($host, $user, $pass, $db)
    {
        parent::__construct($host, $user, $pass, $db);
    }

    public function check_user($token){
        //
    }

    //Достаем с базы данных пользователя если имя совпадает
    public function get_user($alias){

        $sql = "SELECT `id`, `name`, `alias`, `password`, `token` FROM `users` WHERE `alias` = '". $alias . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return False;
        }

        $row = mysqli_fetch_assoc($res);

        return $row;

    }

    //Проверка имени в таблице family на совпадения
    public function check_alias($alias){

        $sql = "SELECT `alias` FROM `users` WHERE `alias`= '" . $alias . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return 'Проблема с подключением к базе данных';
        }

        $row = mysqli_fetch_assoc($res);

//        print_r($row);

        if($row['alias'] == $alias){
            return 'Такой ник уже используется';
        }
        else return TRUE;

    }

    public function save($arr){

        $str = "'" . $arr['name'] . "', '" .$arr['alias'] . "', '" . $arr['pass']. "', '" . $arr['token'] . "'";

        $sql = 'INSERT INTO `users` (`name`, `alias`, `password`, `token`) VALUES ('. $str .')';

        mysqli_query($this->db, $sql);

        if(mysqli_insert_id($this->db) == 0){

            return 'Возникла ошибка при регистрации';
        }

        return mysqli_insert_id($this->db);
    }

}?>