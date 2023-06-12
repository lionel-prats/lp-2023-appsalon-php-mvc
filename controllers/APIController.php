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
            'mensaje' => 'Todo OK'
        ];    
        echo json_encode($respuesta);
    
    } 

}