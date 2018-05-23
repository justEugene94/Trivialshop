<?php
class AdminGoodController extends AdminController{

    public function get_body(){

        if(empty($_SESSION['token'])){

            header('Location: http://phpshop.loc/login');
            die();
        }

        if(!empty($_GET)){

            $id = $this->sanitizeString($_GET['id']);

            $db = new Good(HOST, USER, PASS, DB);

            $good = $db->get_product($id);

            return $this->render('admin_good', ['title'=>'Edit category', 'adminMenu'=>$this->adminMenu, 'good'=>$good]);
        }

        if(!empty($_POST)){

            $input['name'] = $this->sanitizeString($_POST['name']);
            $input['text'] = $this->sanitizeString($_POST['text']);
            $input['price'] = $this->sanitizeString($_POST['price']);

            $validator = $this->validator($input);
            if(is_string($validator) ){
                return $this->render('admin_good', ['title'=>'New product', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$validator]);
            }

            $validatorForPrice = $this->validatorForPrice($input['price']);
            if(is_string($validatorForPrice) ){
                return $this->render('admin_good', ['title'=>'New product', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$validator]);
            }

            if(!is_uploaded_file($_FILES['img']['tmp_name'])) {
                $str = 'Фаил не загрузился';
                return $this->render('admin_good', ['title'=>'New product', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$str]);
            }

            $moveFile = move_uploaded_file($_FILES['img']['tmp_name'], getcwd(). '/img/goods/' . $_FILES['img']['name']);

            if(!$moveFile){
                $str = 'Ошибка загрузки фаила';
                return $this->render('admin_good', ['title'=>'New product', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$str]);
            }

            $input['img'] = $_FILES['img']['name'];

            $db = new Good(HOST, USER, PASS, DB);

            $result = $db->save($input);
            if(is_string($result)){
                return $this->render('admin_good', ['title'=>'New product', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$result]);
            }
            elseif (is_integer($result)){

                $str = 'Товар успешно добавлен';

                return $this->render('admin_index', ['title'=>'Admin page', 'adminMenu'=>$this->adminMenu, 'successStatus'=>$str]);
            }

        }

        return $this->render('admin_good', ['title'=>'New product', 'adminMenu'=>$this->adminMenu]);
    }

    public function edit(){

        if(!empty($_POST)){

            $id = $this->sanitizeString($_POST['id']);
            $input['name'] = $this->sanitizeString($_POST['name']);
            $input['text'] = $this->sanitizeString($_POST['text']);
            $input['price'] = $this->sanitizeString($_POST['price']);

            $validator = $this->validator($input);
            if(is_string($validator) ){
                return $this->render('admin_good', ['title'=>'Edit product', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$validator]);
            }

            $validatorForPrice = $this->validatorForPrice($input['price']);
            if(is_string($validatorForPrice) ){
                return $this->render('admin_good', ['title'=>'Edit product', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$validator]);
            }

            if(is_uploaded_file($_FILES['img']['tmp_name'])){

                $moveFile = move_uploaded_file($_FILES['img']['tmp_name'], getcwd(). '/img/goods/' . $_FILES['img']['name']);

                if(!$moveFile){
                    $str = 'Ошибка загрузки фаила';
                    return $this->render('admin_good', ['title'=>'Edit product', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$str]);
                }

                $input['img'] = $_FILES['img']['name'];
            }
            else{
                $input['img'] = $_POST['old_img'];
            }

            $db = new Good(HOST, USER, PASS, DB);

            $res = $db->change($id, $input);

            if(!$res){

                $str = 'Возникла ошибка';

                return $this->render('admin_index', ['title'=>'Admin Page', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$str]);
            }

            $str = 'Товар изменен';

            return $this->render('admin_index', ['title'=>'Admin Page', 'adminMenu'=>$this->adminMenu, 'successStatus'=>$str]);
        }

        return $this->render('404', ['title'=>'HTTP/1.0 404 Not Found']);
    }

    public function delete(){

        if(!empty($_POST)){

            $id = $this->sanitizeString($_POST['id']);

            $db = new Good(HOST, USER, PASS, DB);

            $res = $db->delete($id);

            if(!$res){

                $str = 'Возникла ошибка';

                return $this->render('admin_index', ['title'=>'Admin Page', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$str]);
            }

            $str = 'Товар удален';

            return $this->render('admin_index', ['title'=>'Admin Page', 'adminMenu'=>$this->adminMenu, 'successStatus'=>$str]);
        }

        return $this->render('404', ['title'=>'HTTP/1.0 404 Not Found']);
    }


}?>