<?php
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email{
protected $phpMailer;
protected $nombre;
protected $email;
protected $token;
protected $imagen = '/build/img/uptask.png';

public function __construct($email,$nombre,$token)
{
    $this->nombre = $nombre ?? '';
    $this->email = $email ?? '';
    $this->token = $token ?? '';
    $this->phpMailer = new PHPMailer();
    $this->phpMailer->isSMTP();
    $this->phpMailer->Host = $_ENV['EMAIL_HOST'];
    $this->phpMailer->SMTPAuth = true;
    $this->phpMailer->Port = $_ENV['EMAIL_PORT'];
    $this->phpMailer->Username = $_ENV['EMAIL_USER'];
    $this->phpMailer->Password = $_ENV['EMAIL_PASS'];
}


public function enviarConfirmacion(){
    $this->phpMailer->setFrom($_ENV['EMAIL_ADDRESS']);
    $this->phpMailer->addAddress($this->email);
    $this->phpMailer->Subject= "Confirma tu cuenta";
    $this->phpMailer->addAttachment(__DIR__ . '/../public/build/img/uptask.png');

    $this->phpMailer->isHTML(TRUE);
    $this->phpMailer->CharSet = "UTF-8";

    $contenido = '<html>';
    $contenido .= '<p><strong> Hola! ' . $this->nombre .' </strong> Has creado tu cuenta en uptask. Solo debes confirmarla en el siguiente enlace: </p>';
    $contenido.= '<p><a href="' . $_ENV['APP_URL'] . '/confirmar?token=' .$this->token .'">Presiona aquí </a></p>';
    $contenido.= "<p>Si tu no creaste esta cuenta, puedes ignorar este mensaje</p>";
    $contenido.= "<img src='" . $this->imagen . "' alt='Logo uptask'>";
    $contenido .= "</html>";


    $this->phpMailer->Body = $contenido;
    $this->phpMailer->send();
}

public function enviarInstrucciones(){
    $this->phpMailer->setFrom($_ENV['EMAIL_ADDRESS']);
    $this->phpMailer->addAddress($this->email);
    $this->phpMailer->Subject= "Restablecer contraseña";
    $this->phpMailer->addEmbeddedImage(__DIR__ . '/../public/build/img/uptask.png',"Logo UPTASK");

    $this->phpMailer->isHTML(TRUE);
    $this->phpMailer->CharSet = "UTF-8";

    $contenido = '<html>';
    $contenido .= '<p><strong> Hola! ' . $this->nombre .' </strong> Has solicitado restablecer tu contraseña. Puedes cambiarla en el siguiente enlace: </p>';
    $contenido.= '<p><a href="' . $_ENV['APP_URL'] . '/restablecer?token=' .$this->token .'">Presiona aquí </a></p>';
    $contenido.= "<p>Si tu no solicitaste este cambio, agregue metodos de seguridad.</p>";
    $contenido.= "<img src='" . $this->imagen . "' alt='Logo uptask'>";
    $contenido .= "</html>";

    $this->phpMailer->Body = $contenido;
    $this->phpMailer->send();
}


}
