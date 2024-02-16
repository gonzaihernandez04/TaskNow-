<?php
namespace Controllers;
use MVC\Router;
use Model\Proyecto;
class DashboardController{


    public static function index(Router $router){
        session_start();
   
        isAuth();

        $proyectos = Proyecto::all();


        $router->render('/dashboard/index',[
            "titulo" => "Proyectos",
            "nombre" => $_SESSION['username'],
            "proyectos"=>$proyectos
        ]);
      
    }

    public static function crear(Router $router){
        session_start();
        isAuth();
        $alertas = [];

        $router->render('/dashboard/crear-proyecto',[
            "titulo" => "Nuevo proyecto",
            "nombre" => $_SESSION['username'],
            "alertas" =>$alertas
        ]);
      
    }

    public static function perfil(Router $router){
        session_start();
        isAuth();

        $router->render('/dashboard/perfil',[
            "titulo" => "Mi Perfil",
            "nombre" => $_SESSION['username']
        ]);
      
    }
}

