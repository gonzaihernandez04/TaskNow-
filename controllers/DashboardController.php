<?php
namespace Controllers;
use MVC\Router;
class DashboardController{


    public static function index(Router $router){
        session_start();
   
        if(empty($_SESSION)) header("Location: /");



        $router->render('/dashboard/index',[
            "titulo" => "Dashboard",
            "nombre" => $_SESSION['username']
        ]);
      
    }
}

