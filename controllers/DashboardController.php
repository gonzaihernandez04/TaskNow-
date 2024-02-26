<?php

namespace Controllers;

use MVC\Router;
use Model\Proyecto;
use Model\Usuario;

class DashboardController
{


    public static function index(Router $router)
    {
        session_start();

        isAuth();

        $proyectos = Proyecto::belongsTo('idUsuario', $_SESSION['id']);

        $router->render('/dashboard/index', [
            "titulo" => "Proyectos",
            "nombre" => $_SESSION['username'],
            "proyectos" => $proyectos
        ]);
    }

    public static function crear(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];

        $proyecto = new Proyecto;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $proyecto = new Proyecto($_POST);

            //Validacion
            $alertas = $proyecto->comprobarCampos();
            if (empty($alertas)) {

                //Generar una URL unica
                $proyecto->urlProyecto = substr(md5(uniqid(rand())), 0, 15);


                //Almacenar el creador del proyecto
                $proyecto->idUsuario = $_SESSION['id'];

                //Guardar proyecto
                $resultado = $proyecto->guardar();

                //Redirigir al usuario al proyecto

                if ($resultado) header('Location: /proyecto?urlProyecto=' . $proyecto->urlProyecto);



                debuguear($proyecto);
            }
        }

        $router->render('/dashboard/crear-proyecto', [
            "titulo" => "Nuevo proyecto",
            "nombre" => $_SESSION['username'],
            "proyecto" => $proyecto,
            "alertas" => $alertas
        ]);
    }


    public static function proyecto(Router $router)
    {
        session_start();
        isAuth();

        //Revisar que la persona que visita el proyecto, es quien lo creo
        $token = $_GET['urlProyecto'];
        if (!$token) header('Location: /dashboard');


        $proyecto = Proyecto::where('urlProyecto', $token);

        //Comprobar si al usuario le pertenece el proyecto, en caso de que no, lo redirecciono
        if ($proyecto->idUsuario !== $_SESSION['id']) header("Location: /dashboard");


        $router->render('dashboard/proyecto', [
            "titulo" => $proyecto->nombre,
            "nombre" => $_SESSION['username'],
            "descripcion" => $proyecto->descripcion

        ]);
    }

    public static function perfil(Router $router)
    {
        session_start();
        isAuth();
        $alertas = [];
        $usuario = Usuario::find($_SESSION['id']);
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (($usuario->email != $_POST['email'] || $usuario->email != $_POST['nombre'])) {

                // Reemplaza datos viejos, con los nuevos(LOS DATOS NUEVOS DISPONIBLES, EN ESTE CASO EMAIL Y NOMBRE)
                $usuario->sincronizar($_POST);

                $alertas = $usuario->validar_perfil();

                if (empty($alertas)) {
                    // Verificar si el mail a cambiar existe en otro usuario
                    $existeUsuario = Usuario::where('email', $usuario->email);

                    // Compruebo si existe el usuario y si las id coinciden. Esta validacion sucede porque si el usuario solo desea actualizar su nombre, arrojara el error y dira que ya existe un usuario con ese mail. Entonces, si es la misma ID el que intenta cambiar el usuario, que lo cambie. En caso de que sea diferente, que lo rechace
                    if ($existeUsuario && $existeUsuario->id !== $usuario->id) {
                        Usuario::setAlerta('error', 'El mail ya esta ocupado por otra persona');
                    } else {
                        // Guardar el usuario
                        $usuario->guardar();
                        Usuario::setAlerta('exito', 'Guardado Correctamente');


                        // Asignar nombre nuevo a lña sesion
                        $_SESSION['username'] = $usuario->nombre;
                        $_SESSION['email'] = $usuario->email;
                    }
                }
            }
        }
        $alertas = Usuario::getAlertas();

        $router->render('/dashboard/perfil', [
            "titulo" => "Mi Perfil",
            "nombre" => $usuario->nombre,
            "email" => $usuario->email,
            'alertas' => $alertas
        ]);
    }


    public static function delete()
    {
        session_start();
        isAuth();
        $url = s($_GET['urlProyecto']);
        if (!$url) return;

        $proyecto = Proyecto::where('urlProyecto', $url);
        if ($proyecto) {
            $proyecto->eliminar();
        }
        header('Location: /dashboard');
    }


    public static function cambiarPassword(Router $router)
    {
        session_start();
        isAuth();

        $alertas = [];
        $usuario = Usuario::where('id', $_SESSION['id']);
  
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
            // Compruebo si la contraseña hasheada es igual a la contraseña nueva.
            if ($usuario->comprobarContraseña(s($_POST['passwordActual'])) && !$usuario->comprobarContraseña($_POST['pass'])) {

                // Sincronizar con los datos del usuario
                $usuario->sincronizar($_POST);

                // Validar contraseña
                $alertas = $usuario->validarNuevaPassword();

                if (empty($alertas)) {
                    // Hashear password
                    $usuario->hashPassword();
                    // quitar campo de password2
                    unset($usuario->pass2);

                    $resultado = $usuario->guardar();

                    if($resultado) $alertas = Usuario::setAlerta('exito','Contraseña cambiada correctamente');


                }

            }else{
                Usuario::setAlerta('error','La contraseña original no coincide con la ingresada. O la nueva contraseña es igual que la anterior');
            }
        }
        $alertas = Usuario::getAlertas();

        $router->render('/dashboard/cambiar-password', [
            'titulo' => 'Cambiar contraseña',
            'nombre' => $usuario->nombre,
            'alertas' => $alertas
        ]);
    }
}
