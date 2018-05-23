<?php
class AdminCategoryController extends AdminController{

    public function get_body(){

        if(empty($_SESSION['token'])){

            header('Location: http://phpshop.loc/login');
            die();
        }

        if(!empty($_GET)){

            $id = $this->sanitizeString($_GET['id']);

            $db = new Category(HOST, USER, PASS, DB);

            $category = $db->get_one($id);

            return $this->render('admin_category', ['title'=>'Edit category', 'adminMenu'=>$this->adminMenu, 'category'=>$category]);
        }

        if(!empty($_POST)){

            $name = $this->sanitizeString($_POST['name']);

            $validator = $this->validator($name);
            if(is_string($validator) ){
                return $this->render('admin_category', ['title'=>'New category', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$validator]);
            }

            $db = new Category(HOST, USER, PASS, DB);

            $res = $db->check_category($name);
            if(is_string($res)){
                return $this->render('admin_category', ['title'=>'New category', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$res]);
            }

            $result = $db->save($name);
            if(is_string($result)){
                return $this->render('admin_category', ['title'=>'New category', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$result]);
            }
            elseif (is_integer($result)){

                $str = 'Категория успешно добавлена';

                return $this->render('admin_index', ['title'=>'Admin page', 'adminMenu'=>$this->adminMenu, 'successStatus'=>$str]);
            }

        }

        return $this->render('admin_category', ['title'=>'New category', 'adminMenu'=>$this->adminMenu]);
    }

    public function edit(){

        if(!empty($_POST)){

            $id = $this->sanitizeString($_POST['id']);
            $name = $this->sanitizeString($_POST['name']);

            $validator = $this->validator($name);
            if(is_string($validator) ){
                return $this->render('admin_category', ['title'=>'New category', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$validator]);
            }

            $db = new Category(HOST, USER, PASS, DB);

            $res = $db->change($id, $name);

            if(!$res){

                $str = 'Возникла ошибка';

                return $this->render('admin_index', ['title'=>'Admin Page', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$str]);
            }

            $str = 'Категория изменена';

            return $this->render('admin_index', ['title'=>'Admin Page', 'adminMenu'=>$this->adminMenu, 'successStatus'=>$str]);
        }

        return $this->render('404', ['title'=>'HTTP/1.0 404 Not Found']);
    }

    public function delete(){

        if(!empty($_POST)){

            $id = $this->sanitizeString($_POST['id']);

            $db = new Category(HOST, USER, PASS, DB);

            $res = $db->delete($id);

            if(!$res){

                $str = 'Возникла ошибка';

                return $this->render('admin_index', ['title'=>'Admin Page', 'adminMenu'=>$this->adminMenu, 'ErrorStatus'=>$str]);
            }

            $str = 'Категория удалена';

            return $this->render('admin_index', ['title'=>'Admin Page', 'adminMenu'=>$this->adminMenu, 'successStatus'=>$str]);
        }

        return $this->render('404', ['title'=>'HTTP/1.0 404 Not Found']);
    }


}?>