<?php 

namespace Controllers;

//use MVC\Router;
use Model\AdminCita;

class AdminController {
    public static function index(/* Router */ $router){
        // isAuth();

        // debuguear(date("Y-m-d H:i:s"));

        $fecha = $_GET["fecha"] ?? date("Y-m-d");
        
        if($fecha === "") $fecha = date("Y-m-d");

        $fecha = explode("-", $fecha);
        $esFechaValida = checkdate($fecha[1], $fecha[2], $fecha[0]);
        if(!$esFechaValida) {
            header("Location: /404");
        }
        $fecha = implode("-", $fecha);
        
        $consulta = "
            SELECT citas.id, citas.hora, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS cliente, usuarios.email, usuarios.telefono, servicios.nombre AS servicio, servicios.precio 
            FROM citas
            LEFT OUTER JOIN usuarios ON usuarios.id = citas.usuarioId 
            LEFT OUTER JOIN citasservicios ON citasservicios.citaId = citas.id  
            LEFT OUTER JOIN servicios ON servicios.id = citasservicios.servicioId  
            WHERE fecha = '$fecha'
        ";
        $citas = AdminCita::SQL($consulta); // ver explicacion detallada en z.notas.txt, VIDEO 534

        $router->render("admin/index", [
            //"id" => $_SESSION["id"],
            "nombre" => $_SESSION["nombre"],
            "citas" => $citas,
            "fecha" => $fecha
        ]);
    }
}