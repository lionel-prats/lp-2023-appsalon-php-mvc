<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }    
    
    public function enviarConfirmacion() {

        // email que se enviara al usuario que este intentando crear su cuenta
        $contenido = "
            <html>
                <p>Hola <strong>$this->nombre!</strong></p>
                <p>Has solicitado la creación de tu cuenta en AppSalon.</p> 
                <p>Click <a href='http://localhost:3000/confirmar-cuenta?token=$this->token'>aquí</a> para confirmar tu cuenta.</p>
                <small style=\"color: red;\">- Si tú no solicitaste la creación de esta cuenta, simplemente ignora este mensaje. -</small>
            </html>
        ";

        // crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP(); // SMTP -> protocolo de envio de emails
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'your_email_username';
        $mail->Password = 'your_email_password';
        $mail->setFrom('your_email_accoount@yout_host.com');
        //$mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu cuenta';
        $mail->isHTML(true); 
        $mail->CharSet = "UTF-8";
        $mail->Body = $contenido;
        $mail->send();
    }
}
