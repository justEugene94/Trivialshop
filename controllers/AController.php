<?php

abstract class AController {

    protected function render($file, $params){
        extract($params);
        ob_start();
        include('views/'. $file . '.php');
        return ob_get_clean();
    }

    //Компоненты меню админки
    public $adminMenu = [
                        ['id'=>1, 'name'=>'Категории'],
                        ['id'=>2, 'name'=>'Товары']
                        ];

    //Компоненты меню в магазине
    public function getMenu(){
        $db = new Category(HOST, USER, PASS, DB);
        $menu = $db->get_all();

        return $menu;
    }

    //Простая валидация через регулярное выражение
    protected function validator($request){

        $pattern = '/[а-яА-яёЁa-zA-Z0-9]+$/';

        if(is_array($request)) {
            foreach ($request as $item) {
                if (empty($item)) {
                    return 'Вы не заполнили поле';
                } elseif (preg_match($pattern, $item)) {
                    $arr[] = $item;
                } else {
                    return 'Поле заполнено не верно';
                }
            }
            return $arr;
        }
        else{
            if (empty($request)) {
                return 'Вы не заполнили поле';
            } elseif (preg_match($pattern, $request)) {
                $string = $request;
            } else {
                return 'Поле заполнено не верно';
            }

            return TRUE;
        }
    }

    protected function validatorForPrice($request){

        $pattern = '/[0-9]+$/';

        if(empty($request)){
            return 'Вы не заполнили поле';
        } elseif (preg_match($pattern, $request)) {
            $string = $request;
        } else {
            return 'Поле заполнено не верно1';
        }

        return TRUE;
    }


    //Зашита от вредоносных инъекций
    protected function sanitizeString($var)
    {
        if(is_array($var)){
            foreach ($var as $item){
                $item = stripslashes($item);
                $item = strip_tags($item);
                $item = htmlentities($item);
                $var[] = $item;
            }
            return $var;
        }else{
            $var = stripslashes($var);
            $var = strip_tags($var);
            $var = htmlentities($var);
            return $var;
        }

    }

    abstract public function get_body();

}
?>