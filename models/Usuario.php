<?php
namespace Model;
use Model\ActiveRecord;

class Usuario extends ActiveRecord{

    protected static $tabla = 'usuario';
    protected static $columnasDB = ['id','nombre','email','pass','token','confirmado','ultimaSolicitudEnviada'];
    public $id;
    public $nombre;
    public $email;
    public $pass; 
    public $token;
    public $confirmado;
    public $pass2;

    public $ultimaSolicitudEnviada;
 
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->pass = $args['pass'] ?? '';
        $this->pass2 = $args['pass2'] ?? null;
        $this->token = $args['token'] ?? '';

        $this->confirmado = $args['confirmado'] ?? '';

        $this->ultimaSolicitudEnviada = $args['ultimaSolicitudEnviada'] ?? null;
    }

    public function validarNuevaCuenta() : array{
        if(!$this->nombre) self::$alertas['error'][] = "El nombre es obligatorio";
        if(!$this->email) self::$alertas['error'][] = "El email es obligatorio";
        if(!$this->pass) self::$alertas['error'][] = "La contraseña es obligatoria";
        if(strlen($this->pass)<6) self::$alertas['error'][] = "La contraseña debe contener al menos 6 caracteres";
        if($this->pass!=$this->pass2)  self::$alertas['error'][] = "Las contraseñas deben ser iguales";
        return self::$alertas;
    }

    public function validarPassword() : array{
        if(strlen($this->pass)<6) self::$alertas['error'][] =  "La contraseña debe contener al menos 6 caracteres";
        if(!$this->pass) self::$alertas['error'][] =  "Debes escribir una contraseña";
        return self::$alertas;
    }

    public function generarToken() : void{
        $this->token = substr(uniqid(md5(rand())),0,15);
    }
    public function hashPassword() : void{
        $this->pass = password_hash($this->pass,PASSWORD_BCRYPT);
    }

    public function comprobarMailRecuperacion() : array{
        if(!$this->email) self::$alertas['error'][] = "Debe escribir el mail correspondiente a su cuenta";
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            self::$alertas['error'][] = "Email no valido";

        }
        return self::$alertas;
    }

    public function validarCamposInicioSesion() : array{
        if(!$this->email) self::$alertas['error'][] = "El campo del mail debe estar lleno";
        if(!$this->pass) self::$alertas['error'][] = "El campo de la contraseña debe estar lleno";
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)) self::$alertas['error'][] = "Debe colocar un mail y no un texto";


        return self::$alertas;
    }

    public function comprobarContraseña($pass) :  bool{

        return password_verify($pass,$this->pass);
    
    }

    public function validar_perfil() : array{
        if(!$this->email) self::$alertas["error"][] = "El mail es obligatorio";
        if(!$this->nombre) self::$alertas["error"][] = "El nombre es obligatorio";
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)) self::$alertas["error"][] = "Coloque un email";
        return self::$alertas;
    }

    public function validarNuevaPassword() : array{
        if(!$this->pass || !$this->pass2)  self::$alertas["error"][]  = "Debes colocar una contraseña en ambos campos";
        if($this->pass2 != $this->pass)  self::$alertas["error"][]  = "Las contraseñas deben ser iguales";
        if(strlen($this->pass)<6 || strlen($this->pass2)<6)  self::$alertas["error"][] = "La contraseña debe contener al menos 6 caracteres";
        return self::$alertas;

    }





}


