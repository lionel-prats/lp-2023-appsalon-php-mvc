<?php 

namespace Controllers;

use Model\Cita;
use Model\Servicio;

class APIController {
    public static function index(){
        //sleep(2);
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }
    public static function guardar(){ // http://localhost:3000/api/citas
        
        $cita = new Cita($_POST);

        $resultado = $cita->guardar();
    
        echo json_encode($resultado);
    
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