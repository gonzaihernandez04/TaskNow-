<?php

namespace Controllers;

use Model\Proyecto;
use Model\Tarea;

class TareaController{

    public static function index(){
        session_start();  

        $urlProyecto = $_GET['urlProyecto'];

        if(!$urlProyecto) header('Location: /dashboard');

        $proyecto = Proyecto::where('urlProyecto',$urlProyecto);
        
        if(!$proyecto || $proyecto->idUsuario!=$_SESSION['id']) header('Location: /404');

        $tareas = Tarea::belongsTo('idProyecto',$proyecto->id);

        echo json_encode(['tareas'=>$tareas]);
    }

    public static function crear(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            session_start();
            $proyecto = Proyecto::where('urlProyecto', $_POST['idProyecto']);
           
            if(!$proyecto || $proyecto->idUsuario !== $_SESSION['id']){
                $respuesta = [
                    "tipo"=>"error",
                    "mensaje"=>"Hubo un error al agregar la tarea"
                ];
                echo json_encode($respuesta);
                return;
            }

            
            $datosTarea = [
                "idProyecto"=> $proyecto->id,
                "nombre"=>$_POST['nombre'],
            ];
            $tarea = new Tarea($datosTarea);

            $resultado = $tarea->guardar();

            $respuesta = [
                "tipo"=>"exito",
                "mensaje"=>"Tarea agregada correctamente",
                "id"=>$resultado['id'],
            ];

            echo json_encode($respuesta);
        }

    }


    public static function actualizar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
        }

    }


    public static function eliminar(){

    }

}