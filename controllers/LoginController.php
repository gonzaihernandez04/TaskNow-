<?php
namespace Controllers;
use MVC\Router;

class LoginController{


   

    public static function login(Router $router){
        if($_SERVER['REQUEST_METHOD'] == "POST"){

        }

        $router->render('auth/index',[
            "titulo" =>'Iniciar Sesion'
        ]);

    }

    public static function crear(Router $router){
        if($_SERVER['REQUEST_METHOD'] == "POST"){

        }

        $router->render('auth/crear',[
            "titulo" =>'Crear cuenta en UPTASK'
        ]);
    }

    public static function recuperar(Router $router){
        if($_SERVER['REQUEST_METHOD'] == "POST"){

        }

        $router->render('auth/recuperar',[
            "titulo" => 'Olvide mi contraseña'
        ]);
    }



    public static function restablecer(Router $router){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

        }
        $router->render('auth/restablecer',[
            "titulo" => "Restablecer contraseña"
        ]);

    }
    
    public static function mensaje(Router $router){
       
        $router->render('auth/mensaje',[
            'titulo' => 'Cuenta creada exitosamente'
        ]);

    }
    
    public static function confirmar(Router $router){
        echo "desde mensaje";

        $router->render('auth/confirmar',[
            "titulo"=>'Confirma tu cuenta'
        ]);

    }
    
    public static function logout(){
      
     

    }


}


?>