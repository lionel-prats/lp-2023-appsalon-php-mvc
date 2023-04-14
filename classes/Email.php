<?php 

namespace Classes;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }    
    
}

/*
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

//require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if(isset($_POST["send"])) {

    $name = htmlentities($_POST["name"]);
    $email = htmlentities($_POST["email"]);
    $subject = htmlentities($_POST["subject"]);
    $message = htmlentities($_POST["message"]);
    // comente la funcion htmlentities (que no se que hace) porque no me tomaba los caracteres extraños la casilla de correo destinataria

    $full_message = "
    <p>Name: $name</p>
    <p>Email: $email</p>
    <p>Subject: $subject</p>
    <p>Message: $message</p>
";

    $mail = new PHPMailer(true);
    $mail->isSMTP();                                            
    $mail->Host = 'smtp.gmail.com';                     
    $mail->SMTPAuth = true; 
    $mail->Username = 'bienesraices20230410@gmail.com';                     
    $mail->Password = 'hphfsbmvevcsrcds';                               
    $mail->Port = 465;                                    
    $mail->SMTPSecure = "ssl";
    
    $mail->setFrom($email, $name);    
    $mail->addAddress('bienesraices20230410@gmail.com');     

    $mail->isHTML(true);  
    $mail->Subject = $subject;
    $mail->Body = $full_message;    
    $mail->CharSet = 'UTF-8';
    
    $mail->send();
    
    header('Location: ./response.php');
}
*/