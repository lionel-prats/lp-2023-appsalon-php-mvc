<?php 

namespace Controllers;

use Classes\Email;
use Model\Usuario;
//use MVC\Router;

require __DIR__ . "/../views/partials/enlaces-form.php";

class LoginController {

    public static function login(/* Router */ $router) {

        $first_path = "/crear-cuenta"; 
        $first_brand = "¿Aún no tienes una cuenta? Crear una";
        $second_path = "/olvide";
        $second_brand = "¿Olvidaste tu password?";
        $componenteEnlacesForm = componenteEnlacesForm($first_path, $first_brand, $second_path, $second_brand);

        $router->render("auth/login", [
            "componenteEnlacesForm" => $componenteEnlacesForm
        ]);
    }

    public static function logout() {
        echo "Desde logout";
    }
    
    public static function olvide(/* Router */ $router) {
        $first_path = "/"; 
        $first_brand = "¿Ya tienes una cuenta? Inicia sesión";
        $second_path = "/crear-cuenta"; 
        $second_brand = "¿Aún no tienes una cuenta? Crear una";
        $componenteEnlacesForm = componenteEnlacesForm($first_path, $first_brand, $second_path, $second_brand);

        if($_SERVER["REQUEST_METHOD"] === "POST") {

        }
        $router->render("auth/olvide", [
            "componenteEnlacesForm" => $componenteEnlacesForm
        ]);
    }

    public static function recuperar(/* Router */ $router) {
        echo "Desde recuperar";
    }

    public static function crear(/* Router */ $router) {

        $first_path = "/"; 
        $first_brand = "¿Ya tienes una cuenta? Inicia sesión";
        $second_path = "/olvide";
        $second_brand = "¿Olvidaste tu password?";
        $componenteEnlacesForm = componenteEnlacesForm($first_path, $first_brand, $second_path, $second_brand);

        $usuario = new Usuario();
        
        // alertas vacias
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
            // revisar que no hayan errores de validacion 
            if(empty($alertas)) {
                // verificar que el usuario no este registrado
                // este metodo busca en la tabla usuarios un registro con el mail almacenado en $usuario->email
                $resultado = $usuario->existeUsuario($usuario->email);
                if($resultado) { 
                    // hashear el password
                    // este metodo haschea el password ingresado por el usuario, almacenado en $usuario->password
                    $usuario->hashPassword();
                    
                    // generar un token unico  
                    // este metodo le asigna un token unico a $usuario->token
                    $usuario->crearToken();

                    // enviar el email (con el token) vvv

                    // instancia de la clase Email
                    $email = new Email(
                        $usuario->email,
                        $usuario->nombre,
                        $usuario->token
                    );

                    // metodo de Email para enviar el correo de confirmacion de cuenta al usuario, usando la libreria PHPMailer 
                    $email->enviarConfirmacion();
                    
                    // crear el usuario
                    $resultado = $usuario->guardar();

                    if($resultado){
                        header("Location: /mensaje");
                    }
                
                } 

                $alertas = Usuario::getAlertas();
            }
        }

        $router->render("auth/crear-cuenta", [
            "componenteEnlacesForm" => $componenteEnlacesForm,
            "usuario" => $usuario,
            "alertas" => $alertas,
        ]);
    }

    public static function mensaje($router) {
        $router->render("auth/mensaje");
    }

    public static function confirmar($router) {
            
        $alertas = [];
        
        if(isset($_GET['token'])) {
            $token = s($_GET['token']);

            $usuario = Usuario::where('token', $token); // SELECT * FROM usuarios WHERE token = queryString token recibido por GET (retorna uun array de objetos - cada objeto es un registro retornado por la consulta SQL)
        
            if(empty($usuario)) {
                // en la peticion get, el valor del queryString token no fue encontrado en los registros de usuarios en la DB
                Usuario::setAlerta("error", "Token inválido");
            } elseif(count($usuario) === 1){
                // en la peticion get, el valor del queryString token coincide con un unico registros de usuarios en la DB, por lo cual UPDATEAMOS el registro en cuestion y notificamos al usuario de la confirmacion de registro de usuario exitosa
                $usuario = $usuario[0];
                $usuario->confirmado = "1";
                $usuario->token = "";
                $usuario->guardar();
                Usuario::setAlerta("exito", "Felicitaciones $usuario->nombre!! Te has registrado correctamente!!");

            } else {
                // el token de confirmacion de usuario esta duplicado en la DB: hay que hacer un DELETE y pedirle al usuario que se registre nuevamente
                Usuario::setAlerta("error", "Ha ocurrido un error inesperado 😩");
                Usuario::setAlerta("error", "Por favor, vuelve a completar el <a href=\"http://localhost:3000/crear-cuenta\">formulario de registro de usuario</a> 🙏🏻🙏🏻🙏🏻");
            }
        
        } else {
            // en la peticion get no existe el queryString token; deberia redirigir a alguna otra vista (probablemente de error)
            Usuario::setAlerta("error", "Token inválido");
        } 

        $alertas = Usuario::getAlertas();
        
        $router->render("auth/confirmar-cuenta", [
            'alertas' => $alertas
        ]);
    }
}


