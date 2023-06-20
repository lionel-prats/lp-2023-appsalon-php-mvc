<?php

namespace Model;

class Servicio extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id','nombre','precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar() {
        //$expresion_regular_precio = "|^\d\d?\d?\d?\d?$|"; 
        if(!$this->nombre) {
            self::$alertas["error"][] = "El nombre del servicio es obligatorio"; 
        }
        if(!$this->precio) {
            self::$alertas["error"][] = "El precio del servicio es obligatorio";
        } elseif(!is_numeric($this->precio) ){
            self::$alertas["error"][] = "El precio ingresado no es válido";
        }/* elseif(!preg_match($expresion_regular_precio, $this->precio)) {
            self::$alertas["error"][] = "El precio del servicio debe contener entre 1 y 5 dígitos numéricos";
        } */
        return self::$alertas;
    }

}