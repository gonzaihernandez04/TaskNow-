<?php
namespace Model;
use Model\ActiveRecord;

class Usuario extends ActiveRecord{

    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id','nombre','email','pass','token','confirmado'];
    public $id;
    public $nombre;
    public $email;
    public $pass; 
    public $token;
    public $confirmado;
    public $pass2;
    public function __construct()
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->pass = $args['pass'] ?? '';
        $this->pass2 = $args['pass2'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '';
    }

    public function validarNuevaCuenta(){
        if(!$this->nombre) self::$alertas['error'][] = "El nombre es obligatorio";
        if(!$this->email) self::$alertas['error'][] = "El email es obligatorio";
        if(!$this->pass) self::$alertas['error'][] = "La contraseña es obligatoria";
        if(!strlen($this->pass)<6) self::$alertas['error'][] = "La contraseña debe contener al menos 6 caracteres";
        if($this->pass!=$this->pass2) self::$alertas['error'][] = "Las contraseñas deben ser iguales";
        return self::$alertas;
    }

}




?>