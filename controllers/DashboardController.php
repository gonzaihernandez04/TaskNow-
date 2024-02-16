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

        $proyecto = new Proyecto;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $proyecto = new Proyecto($_POST);

            //Validacion
            $alertas = $proyecto->comprobarCampos();
            if(empty($alertas)){

                //Generar una URL unica
                $proyecto->urlProyecto = substr(md5(uniqid(rand())),0,15);
               

                //Almacenar el creador del proyecto
                $proyecto->idUsuario = $_SESSION['id'];

                //Guardar proyecto
                $resultado = $proyecto->guardar();

                //Redirigir al usuario al proyecto

                if($resultado) header('Location: /proyecto?urlProyecto=' . $proyecto->urlProyecto);



                debuguear($proyecto);
            }
        }

        $router->render('/dashboard/crear-proyecto',[
            "titulo" => "Nuevo proyecto",
            "nombre" => $_SESSION['username'],
            "proyecto"=>$proyecto,
            "alertas" =>$alertas
        ]);
      
    }


    public static function proyecto(Router $router){
        session_start();
        isAuth();

        //Revisar que la persona que visita el proyecto, es quien lo creo
        $token = $_GET['urlProyecto'];
        if(!$token) header('Location: /dashboard');


        $proyecto = Proyecto::where('urlProyecto',$token);

        //Comprobar si al usuario le pertenece el proyecto, en caso de que no, lo redirecciono
        if($proyecto->idUsuario !== $_SESSION['id']) header("Location: /dashboard");



        $router->render('dashboard/proyecto',[
            "titulo"=>$proyecto->nombre,
            "nombre"=>$_SESSION['username']

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

