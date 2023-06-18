<?php 

namespace Controllers;

//use MVC\Router;
use Model\AdminCita;

class AdminController {
    public static function index(/* Router */ $router){
        //session_start();
        //debuguear($_SESSION);
        
        // isAuth();
        
        $reservas = new AdminCita([
            "cliente" => "Damián",
            "servicio" => "completo"
        ]);
        debuguear($reservas);

        $router->render("admin/index", [
            //"id" => $_SESSION["id"],
            "nombre" => $_SESSION["nombre"]
        ]);



    }
}