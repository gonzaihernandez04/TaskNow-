<?php
namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Classes\Email;
use Model\ActiveRecord;

class LoginController{


   

    public static function login(Router $router){
        $alertas = [];
        $authUsuario = new Usuario;
        if($_SERVER['REQUEST_METHOD'] == "POST"){
           $authUsuario = new Usuario($_POST);
           //Valido el inicio de sesion
           $alertas = $authUsuario->validarCamposInicioSesion();
            if(empty($alertas)){
                //Adquiero el objeto del usuario correspondiente a traves del email puesto en el login
                $usuario = $authUsuario->where('email',$authUsuario->email);

                //Compruebo si esta confirmado

                //compruebo la contraseña
                if(!$usuario->comprobarContraseña($authUsuario->pass) || !$usuario->confirmado){
                    Usuario::setAlerta("error","La contraseña no es correcta o el usuario no esta confirmado");
                }else{
                    session_start();
                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['username'] = $usuario->nombre;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['login'] = true;
                    header('Location: /dashboard');
                    
                }

            }


        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/index',[
            "titulo" =>'Iniciar Sesion',
            "alertas"=>$alertas,
            "authUsuario"=>$authUsuario
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

        $alertas = [];
        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $usuario->sincronizar($_POST);

            $alertas = $usuario->comprobarMailRecuperacion();
            if(empty($alertas)){
                $usuario = Usuario::where('email',$usuario->email);
                if($usuario && $usuario->confirmado) {

                    //Generar un nuevo token
                    $usuario->generarToken();
                    unset($usuario->pass2);

                    //Actualizar el usuario

                    $usuario->guardar();

                    //Enviar el email
                    $email = new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarInstrucciones();

                    //Imprimir la alerta
                    Usuario::setAlerta("exito","Hemos enviado las instrucciones a tu email");

                }else{
                    Usuario::setAlerta("error","El usuario no existe o no esta confirmado");

                }

            }

            
        }
        $alertas = Usuario::getAlertas();
    
        $router->render('auth/recuperar',[
            "titulo" => 'Olvide mi contraseña',
            "alertas" => $alertas,
            "usuario" => $usuario
        ]);
    }



    public static function restablecer(Router $router){
        $alertas = [];
        $mostrar = 1;
        //Obtener token
        $token = s($_GET['token']);
        //Validar existencia token
        if(!$token) header("Location: /");

        //Buscar usuario
        $usuario = Usuario::where('token',$token);
        if(!$usuario){
            $mostrar = 0;
            Usuario::setAlerta('error',"No existe ningun usuario con ese token");
            $alertas = Usuario::getAlertas();

        }

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //Sincronizo el objeto original con la nueva contraseña
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarPassword();
            
            if(empty($alertas)){
                //Hasheo el password
                $usuario->hashPassword();

                //Borro el token
                $usuario->token = null;

                //Lo guardo en la base de datos
                $resultado = $usuario->guardar();
                //Redireccionar
                if($resultado){
                    $mostrar=0;
                   Usuario::setAlerta('exito',"La contraseña se cambio correctamente");
                }

            }

        }
    
        $alertas = Usuario::getAlertas();
        $router->render('auth/restablecer',[
            "titulo" => "Restablecer contraseña",
            "alertas"=>$alertas,
            "mostrar"=>$mostrar
        
        ]);

    }
    
    public static function mensaje(Router $router){
       
        

        $router->render('auth/mensaje',[
            'titulo' => 'Cuenta creada exitosamente'
        ]);

    }
    
    public static function confirmar(Router $router){
        $alertas = [];
        //Obtener token
        $token = s($_GET['token']) ?? '';
        if(!$token) header("Location: /");

        //Encontrar al usuario
        $usuario = Usuario::where('token',$token);

        if(empty($usuario)){
            Usuario::setAlerta("error","Token no valido");
        }else{

            //Confirmamos al usuario
            $usuario->confirmado = 1;

            //Eliminamos el atributo de pass2
            unset($usuario->pass2);
            $usuario->token = null;
            $usuario->guardar();
        }

        Usuario::setAlerta("exito","Cuenta comprobada correctamente");
        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar',[
            "titulo"=>'Confirma tu cuenta',
            "alertas"=> $alertas
        ]);

    }
    
    public static function logout(){
        session_start();
        if(!empty($_SESSION)) $_SESSION = [];
    
        header("Location: /");
    }


}
