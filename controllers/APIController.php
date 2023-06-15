<?php 

namespace Controllers;

use Model\Cita;
use Model\Servicio;
use Model\CitaServicio;

class APIController {

    public static function index(){
        //sleep(2);
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    public static function guardar(){ // http://localhost:3000/api/citas
                
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
    
    public static function pruebas() {
        $cita = new Cita([
            "fecha" => "2023-06-13",
            "hora" => "10:15",
            "nombre" => "Pedro Raul Prats",
            "usuarioId" => "32"
        ]);
        print_r($cita);
    }
}

/* 
{
    "nombre": "Pedro Raul Prats",
    "fecha": "2023-06-13",
    "hora": "10:30",
    "servicios": [
        {
            "id": "4",
            "nombre": "Uñas",
            "id": "75"
        },
        {
            "id": "6",
            "nombre": "Peinado niño",
            "id": "40"
        }
    ]
}

*/