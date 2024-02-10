<?php
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;
use Model\ActiveRecord;

class Email{
protected $phpMailer;
protected $nombre;
protected $email;
protected $token;

public function __construct($email,$nombre,$token)
{
    $this->nombre = $nombre ?? '';
    $this->email = $email ?? '';
    $this->token = $token ?? '';
    
    $this->phpMailer = new PHPMailer();
    $this->phpMailer->isSMTP();
    $this->phpMailer->Host = 'sandbox.smtp.mailtrap.io';
    $this->phpMailer->SMTPAuth = true;
    $this->phpMailer->Port = 2525;
    $this->phpMailer->Username = '94f2e9a2c92946';
    $this->phpMailer->Password = '0a7131951c6720';
}


public function enviarConfirmacion(){
    $this->phpMailer->setFrom("appsalon04@gmail.com");
    $this->phpMailer->addAddress("appsalon04@gmail.com");
    $this->phpMailer->Subject= "Confirma tu cuenta";

    $this->phpMailer->isHTML(TRUE);
    $this->phpMailer->CharSet = "UTF-8";

    $contenido = '<html>';
    $contenido .= '<p><strong>Hola! ' . $this->nombre .' </strong> Has creado tu cuenta en uptask. Solo debes confirmarla en el siguiente enlace: </p>';
    $contenido.= '<p><a href="http://localhost:3000/confirmar?token=' .$this->token .  '">Presiona aquí </a></p>';
    $contenido.= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
    $contenido .= "</html>";

    $this->phpMailer->Body = $contenido;
    $this->phpMailer->send();
}

public function enviarInstrucciones(){



}





}



?>