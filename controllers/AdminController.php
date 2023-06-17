<?php 

namespace Controllers;

use MVC\Router;

class AdminController {
    public static function index(/* Router */ $router){
        //session_start();
        //debuguear($_SESSION);
        
        // isAuth();

        $router->render("admin/index", [
            //"id" => $_SESSION["id"],
            "nombre" => $_SESSION["nombre"]
        ]);



    }
}