<?php

class Database {

    public $db;

    //Подключение к базе данных
    public function __construct($host, $user, $pass, $db){
        $this->db = mysqli_connect($host, $user, $pass);
        if(!$this->db){
            exit('Нет связи с базой данных');
        }

        if(!mysqli_select_db($this->db, $db)){
            exit('Нет таблицы');
        }

        mysqli_query($this->db,'SET NAMES utf8');

        return $this->db;
    }

}
?>