<?php 

namespace Controllers;

use Model\Servicio;

class APIController {
    public static function index(){
        //sleep(2);
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }
}