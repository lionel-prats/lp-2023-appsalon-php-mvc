<?php 

namespace Controllers;

use Model\Servicio;

//use MVC\Router;

class ServicioController {
    public static function index(/* Router */ $router){
        $router->render("/servicios/index", [
            "nombre" => $_SESSION["nombre"]
        ]);
    }
    public static function crear(/* Router */ $router){
        $servicio = new Servicio;
        $alertas = [];
        $servicioCreado = 0;
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if(empty($alertas)) {
                $servicio->guardar();
                $servicioCreado = 1; // esta variable me va a servir para mostrar el cartel de sweetalert de "servicio creado", desde el cliente (impolementacion Lío - VIDEO 548)
                // header("Location: /servicios");
            }
        }
        $router->render("/servicios/crear", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas,
            "servicioCreado" => $servicioCreado
        ]);
    }
    public static function actualizar(/* Router */ $router){
        if($_SERVER["REQUEST_METHOD"] === "POST"){

        }
        $router->render("/servicios/actualizar", [
            "nombre" => $_SESSION["nombre"]
        ]);
    }
    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){

        }
    }
}