<?php 

namespace Controllers;

use Model\Cita;
use Model\Servicio;
use Model\CitaServicio;

class APIController {

    // http://localhost:3000/api/pruebas (GET)
    // endpoint para hacer pruebas en desarrollo
    public static function pruebas() {
        $cita = new Cita([
            "fecha" => "2023-06-13",
            "hora" => "10:15",
            "nombre" => "Pedro Raul Prats",
            "usuarioId" => "32"
        ]);
        print_r($cita);
    }

    // http://localhost:3000/api/servicios (GET)
    // retorna un json con los registros de la tabla "servicios" en la DB
    public static function index(){
        //sleep(2);
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    // http://localhost:3000/api/citas (POST)
    // guarda en la db un nuevo turno, reservado desde http://localhost:3000/cita, usando fetch de JS
    public static function guardar(){ 
                
        $cita = new Cita($_POST); // instancio Cita con lo que envió el usuario desde el form de reserva de turnos
        $resultado = $cita->guardar(); // guardo el turno reservado en citas
        
        $idCita = $resultado["id"];

        $arrayServicios = explode(",", $_POST["servicios"]);

        foreach($arrayServicios as $idServicio) {    
            $args = [
                "citaId" => $idCita, // id del registro creado en citas
                "servicioId" => $idServicio, // id del servicio iterado
            ];
            $cita_servicio = new CitaServicio($args); 
            $cita_servicio->guardar();
        }
        
        echo json_encode(["resultado" => $resultado]); // respuesta del endpoint http://localhost:3000/api/citas
    } 
    
    // http://localhost:3000/api/eliminar (POST)
    // le permite al administrador, desde el panel de administrador, eliminar citas
    public static function eliminar(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            $id = $_POST["id"];
            $cita = Cita::find($id);
            $cita->eliminar();

            header("Location: " . $_SERVER["HTTP_REFERER"]); 
            // ejemplo -> header("Location: http://localhost:3000/admin?fecha=2023-06-21"]);
            
            // ver z.notas.txt VIDEO 542, como generar archivos excel de nuestra info en base de datos (tanto desde PHP como desde JS)
        }
    }
}
