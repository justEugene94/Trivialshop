<?php

class IndexController extends AController {

    public function __construct(){

    }

    public function get_body(){

        if(!empty($_GET)){
            $id = $this->sanitizeString($_GET['id']);

            $db = new Good(HOST, USER, PASS, DB);

            $goods = $db->get_for_category($id);

            return $this->render('index', ['title'=>'Shop','menu' => $this->getMenu(), 'goods'=>$goods]);
        }

        $db = new Good(HOST,USER, PASS, DB);

        $goods = $db->get_all();

        return $this->render('index', ['title'=>'Shop','menu' => $this->getMenu(), 'goods'=>$goods]);

    }

    public function show_product(){

        $id = $this->sanitizeString($_POST['id']);

        $db = new Good(HOST, USER, PASS, DB);

        $product = $db->get_product($id);

        return $this->render('product', ['title'=>'Shop','menu' => $this->getMenu(), 'product'=>$product]);
    }


}
?>