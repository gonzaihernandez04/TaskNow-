<?php
namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Classes\Email;

class LoginController{


   

    public static function login(Router $router){
        if($_SERVER['REQUEST_METHOD'] == "POST"){

        }

        $router->render('auth/index',[
            "titulo" =>'Iniciar Sesion'
        ]);

    }

    public static function crear(Router $router){
        $alertas = [];
        $usuario = new Usuario;
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            if(empty($alertas)){
                $existeUsuario = Usuario::where("email",$usuario->email);
                if($existeUsuario){
                    Usuario::setAlerta('error','El usuario ya esta registrado');
                }else{
                    //Crear nuevo usuario

                    //Hash password
                    $usuario->hashPassword();


                    //Eliminar password2
                    unset($usuario->pass2);

                    //Generar token
                    $usuario->generarToken();
                    $usuario->confirmado = 0;

                   $resultado = $usuario->guardar();

                   $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                   $email->enviarConfirmacion();
                    if($resultado){
                  
                    header("Location: /mensaje");

                   }

                }
            }
          
         
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/crear',[
            "titulo" =>'Crear cuenta en UPTASK',
            "alertas"=>$alertas,
            "usuario" =>$usuario
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

        $router->render('auth/confirmar',[
            "titulo"=>'Confirma tu cuenta'
        ]);

    }
    
    public static function logout(){
      
     

    }


}


?>