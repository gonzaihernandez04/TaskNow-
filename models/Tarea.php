<?php
namespace Model;
use Model\ActiveRecord;

class Tarea extends ActiveRecord{
    protected static $tabla = "tarea";
    protected static $columnasDB = ['id','idProyecto','nombre','estado'];
    public $id;
    public $nombre;
    public $estado;
    public $idProyecto;
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->idProyecto = $args['idProyecto'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->estado = $args['estado'] ?? 0;
    
    }
}