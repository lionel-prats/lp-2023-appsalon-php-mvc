<?php

namespace Model;

class Usuario extends ActiveRecord {

    // base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','apellido','email','password','telefono','admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])
    
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '';
    }

    // mensajes de validacion para la creacion de una cuenta
    public function validarNuevaCuenta() {
        $expresion_regular_telefono = "|^\d\d\d\d\d\d\d\d\d?\d?$|"; 
        
        if(!$this->nombre) {
            self::$alertas["error"][] = "El nombre es obligatorio"; 
        }
        if(!$this->apellido) {
            self::$alertas["error"][] = "El apellido es obligatorio";
        }
        if(!$this->telefono) {
            self::$alertas["error"][] = "El teléfono es obligatorio";
        } elseif(!preg_match($expresion_regular_telefono, $this->telefono)) {
            self::$alertas["error"][] = "El nro. de teléfono debe contener entre 8 y 10 dígitos numéricos";
        }
        if(!$this->email) {
            self::$alertas["error"][] = "El email es obligatorio";
        } elseif(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas["error"][] = "El email ingresado no es válido";
        }
        if(!$this->password || strlen($this->password) < 6) {
            self::$alertas["error"][] = "El password es obligatorio y debe contener al menos 6 caracteres";
        }
        return self::$alertas;
    }

    // revisa si el usuario (email) ya existe en la DB
    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '$this->email' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows) {
            self::$alertas["error"][] = "El email ingresado ya se encuentra registrado";
            return;
        }
        return $resultado;
    }
    // hashea el string que le mandamos (lo usamos para hashear el pass de un nuevo usuario que se registra)
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        return;
    }
    
    // crea un token (lo usamos para generar el token de un nuevo usuario que se registra)
    public function creartoken() {
        $this->token = uniqid();
        return;
    }
}