<?php

include 'config.php';
header("Content-Type: text/html; charset='utf-8'");

function __autoload($file){
    if(file_exists('controllers/' . $file . '.php')){
        require_once 'controllers/' . $file . '.php';
    }
    else {
        require_once 'models/' . $file . '.php';
    }
}

session_start();

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

//if($_SESSION['id']) {

    //Маршрутизация mvc
    switch ($request_uri[0]) {

        // Домашняя страница
        case "/":
            $init = new IndexController();
            echo $init->get_body();
            break;

        //Страница отображения 1 товара
        case "/product":
            $init = new IndexController();
            echo $init->show_product();
            break;

        //Страница админка
        case "/admin":
            $init = new AdminController();
            echo $init->get_body();
            break;

        //Страница авторизации
        case "/login":
            $init = new AuthController();
            echo $init->get_body();
            break;

        //Страница регистрации
        case "/registry":
            $init = new AuthController();
            echo $init->registry();
            break;

        //Выход пользователя из системы
        case "/logout":
            $init = new AuthController();
            echo $init->logout();
            break;

        //Страница создания или редактирования категории
        case "/category":
            $init = new AdminCategoryController();
            echo $init->get_body();
            break;

        //Метод изменения категории
        case "/editcategory":
            $init = new AdminCategoryController();
            echo $init->edit();
            break;

        //Метод удаления категории
        case "/deletec":
            $init = new AdminCategoryController();
            echo $init->delete();
            break;

        //Страница создания и редактирования Товара
        case "/good":
            $init = new AdminGoodController();
            echo $init->get_body();
            break;

        //Метод изменения товара
        case "/editgood":
            $init = new AdminGoodController();
            echo $init->edit();
            break;

        //Метод удаления категории
        case "/deleteg":
            $init = new AdminGoodController();
            echo $init->delete();
            break;

        // Ошибка 404, если введен несуществующий маршрут
        default:
            header('HTTP/1.0 404 Not Found');
            require_once 'views/404.php';
            break;
    }
//}else{
//    //Авторизация
//
//    $init = new AuthController();
//
//    switch ($request_uri[0]) {
//
//        // Login page
//        case "/" :
//            echo $init->get_body();
//            break;
//        case '/login' :
//            echo $init->login();
//            break;
//        // Registry page
//        case "/registry" :
//            echo $init->registry();
//            break;
//
//    }
//}





?>