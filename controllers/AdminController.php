<?php
class AdminController extends AuthController{

    public function get_body(){

        if(empty($_SESSION['token'])){

            header('Location: http://phpshop.loc/login');
            die();
        }

        if(!empty($_GET)){
            $id = $this->sanitizeString($_GET['id']);

            if($id == 1){

                $db = new Category(HOST, USER, PASS, DB);

                $categories = $db->get_all();

                return $this->render('admin_index', ['title'=>'Shop','adminMenu' => $this->adminMenu, 'categories'=>$categories]);
            }
            elseif ($id == 2){

                $db = new Good(HOST, USER, PASS, DB);

                $goods = $db->get_all();

                return $this->render('admin_index', ['title'=>'Shop','adminMenu' => $this->adminMenu, 'goods'=>$goods]);
            }

            return $this->render('404', ['title'=>'HTTP/1.0 404 Not Found']);
        }

        return $this->render('admin_index', ['title'=>'Admin page', 'adminMenu'=>$this->adminMenu]);
    }


}?>