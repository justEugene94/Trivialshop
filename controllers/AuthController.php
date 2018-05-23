<?php

class AuthController extends AController{

//    public function security(){
//
//        if($_SESSION['token']) {
//            $token = $_SESSION['token'];
//
//            $db = new User(HOST, USER, PASS, DB);
//
//            $result = $db->check_user($token);
//
//            return $result;
//        }
//
//        header('Location: http://phpshop.loc/login');
//        die();
//    }

    public function get_body(){

        if(!empty($_POST)){

            $input['alias'] = $this->sanitizeString($_POST['alias']);
            $input['password'] = $this->sanitizeString($_POST['pass']);

//            print_r($input);

            $validator = $this->validator($input);
            if(is_string($validator) ){
                return $this->render('login', ['title'=>'Login Page', 'ErrorStatus'=>$validator]);
            }

            $pass = md5($input['password']);

            $db = new User(HOST, USER, PASS, DB);

            $rep_user = $db->get_user($input['alias']);

            //Запрос к базы данных ничего не вернул
            if(!$rep_user){

                return $this->render('login', ['title'=>'Login Page', 'ErrorStatus'=>'Неверное имя или пароль']);
            }

            //Проверяем только идентичность пароля, так как имя пользователя уже совпало в базе данных
            if($rep_user['password'] == $pass){

                $_SESSION['token'] = $rep_user['token'];

                header('Location: http://phpshop.loc/admin');
                die();
            }

            return $this->render('login', ['title'=>'Login Page', 'ErrorStatus'=>'Неверное имя или пароль']);
        }

        return $this->render('login',['title'=>'Login Page']);
    }


    public function logout(){
        session_destroy();
        header('Location: http://phpshop.loc/');
        die();
    }

    public function registry(){

        if(!empty($_POST)){

            $db = new User(HOST, USER, PASS, DB);

            $input = $this->sanitizeString($_POST);

//            print_r($input);

            $validator = $this->validator($input);
            if(is_string($validator) ){
                return $this->render('registry', ['title'=>'Registry Page', 'ErrorStatus'=>$validator]);
            }

            $checkAlias = $db->check_alias($input['alias']);
            if(is_string($checkAlias)){
                return $this->render('registry', ['title'=>'Registry Page', 'ErrorStatus'=>$checkAlias]);
            }

            if($input['pass'] != $input['pass_confirm']){
                return $this->render('registry', ['title'=>'Registry Page', 'ErrorStatus'=>'Пароль не совпадает']);
            }

            $input['pass'] = md5($input['pass']);

            unset($input['pass_confirm']);

            $input['token'] = md5($input['name'] . $input['alias']);

            $result = $db->save($input);
            if(is_string($result)){
                return $this->render('registry', ['title'=>'Registry Page', 'ErrorStatus'=>$result]);
            }
            elseif (is_integer($result)){

                $_SESSION['token'] = $input['token'];

                header('Location: http://phpshop.loc/admin');
                die();
            }

        }


        return $this->render('registry', ['title'=>'Registry Page']);
    }


}?>