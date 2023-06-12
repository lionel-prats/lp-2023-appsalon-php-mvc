<?php 

namespace Controllers;

use Model\Servicio;

class APIController {
    public static function index(){
        //sleep(2);
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }
    public static function guardar(){
        // http://localhost:3000/api/citas
        $respuesta = [
            'datos' => $_POST
        ];    
        echo json_encode($respuesta);
    
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