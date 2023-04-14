<?php 

namespace Controllers;

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
                $resultado = $usuario->existeUsuario($usuario->email);
                if($resultado) { 
                    // hashear el password
                    $usuario->hashPassword();
                    debuguear($usuario);
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
}


