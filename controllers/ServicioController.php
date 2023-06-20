<?php 

namespace Controllers;

use Model\Servicio;

//use MVC\Router;

class ServicioController {
    public static function index(/* Router */ $router){
        $servicios = Servicio::all();
        $router->render("/servicios/index", [
            "nombre" => $_SESSION["nombre"],
            "servicios" => $servicios
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
    
        // valido que el id que llega por GET sea valido
        if($_SERVER["REQUEST_METHOD"] === "GET"){
            idValido($_GET, "id");
            $servicio = Servicio::find($_GET["id"]);
        }

        // valido que el id que llega por POST sea valido
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            idValido($_POST, "id");
            $servicio = new Servicio;
            $servicio->sincronizar($_POST);
        }

        if(!$servicio){
            header("Location: /servicios");
        }

        $alertas = [];
        $servicioCreado = 0;
        
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $alertas = $servicio->validar();
            if(empty($alertas)) {
                $servicio->guardar();
                $servicioCreado = 1; // esta variable me va a servir para mostrar el cartel de sweetalert de "servicio actualizado", desde el cliente (impolementacion Lío - VIDEO 551)
            }
        }
        $router->render("/servicios/actualizar", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas,
            "servicioCreado" => $servicioCreado
        ]);
    }
    public static function eliminar(/* $router */){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            // header("Location: " . $_SERVER["HTTP_REFERER"]); 
            header("Location: /servicios"); 
        }
    }
}