<?php
namespace Model;
use Model\ActiveRecord;
class Proyecto extends ActiveRecord{

    public $id;
    public $idUsuario;
    public $nombre;
    public $descripcion;
    public $urlProyecto;

    protected static $tabla = 'proyecto';
    protected static $columnasDB = ['id','idUsuario','nombre',"descripcion","urlProyecto"];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->idUsuario = $args['idUsuario'] ?? '';
    }


    public function comprobarCampos(){
        if(!$this->nombre) self::$alertas['error'][] = "El proyecto debe tener un nombre";
        if(!$this->descripcion) self::$alertas['error'][] = "El proyecto debe tener una descripcion";
        return self::$alertas;
    }
    


}


?>