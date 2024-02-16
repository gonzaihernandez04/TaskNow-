<?php
namespace Controllers;
use MVC\Router;
class DashboardController{


    public static function index(Router $router){
        session_start();
   
        if(empty($_SESSION)) header("Location: /");



        $router->render('/dashboard/index',[
            "titulo" => "Proyectos",
            "nombre" => $_SESSION['username']
        ]);
      
    }

    public static function crear(Router $router){
        session_start();
        if(empty($_SESSION)) header("Location: /");

        $router->render('/dashboard/crear-proyecto',[
            "titulo" => "Nuevo proyecto",
            "nombre" => $_SESSION['username']
        ]);
      
    }
}

