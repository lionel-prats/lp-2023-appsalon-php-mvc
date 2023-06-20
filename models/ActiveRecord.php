<?php
namespace Model;
class ActiveRecord {

    // Base DE DATOS
    protected static $db;
    protected static $tabla = ''; // nombre de la tabla
    protected static $columnasDB = []; // array con los campos de cada tabla, definidos en cada modelo (se puede acceder y definir desde cada modelo que herede esta clase, gracias a que definimos al atributo como protected static -VIDEO 522-)

    // Alertas y Mensajes
    protected static $alertas = [];
    
    // Definir la conexión a la BD - includes/database.php
    public static function setDB($database) {
        self::$db = $database;
    }

    public static function setAlerta($tipo, $mensaje) {
        static::$alertas[$tipo][] = $mensaje;
    }

    // Validación
    public static function getAlertas() {
        return static::$alertas;
    }

    public function validar() {
        static::$alertas = [];
        return static::$alertas;
    }

    // Consulta SQL para crear un objeto en Memoria
    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        
        
        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            
            
            // echo "<pre>";
            // print_r($registro);
            // echo "</pre>";
        
            $array[] = static::crearObjeto($registro);
        }
        //debuguear($resultado);
        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        // $array = array de objetos/instancias de un modelo (cada objeto es un registro, parte de una consulta SQL a la BD)
        return $array;
    }

    // Crea el objeto en memoria que es igual al de la BD
    // VIDEO 497 - recibe un array y lo convierte en objeto
    protected static function crearObjeto($registro) {
        // instancia del modelo que invoque este metodo crearObjeto (en este caso, Servicio - VIDEO 497)
        // tambien lo invoca el modelo AdminCita (VIDEO 534)
        $objeto = new static; 
        
        // echo "<pre>";
        // print_r($registro);
        // echo "</pre>";
        // debuguear($objeto);
        /* 
        VIDEO 497
        object(Model\Servicio)#5 (3) {
            ["id"]=>
            NULL
            ["nombre"]=>
            string(0) ""
            ["precio"]=>
            string(0) ""
        }
        */
        
        foreach($registro as $key => $value ) {
            if(property_exists( $objeto, $key  )) {
                $objeto->$key = $value;
            }
        }
        
        // debuguear($objeto);
        return $objeto;
    }

    // Identificar y unir los atributos de la BD
    public function atributos() {
       
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue; // de esta forma evita la ejecucion del codigo siguiente cuando la iteracion se corresponda con $columna === 'id', saltanto automaticamente a la sigiuente iteracion
            $atributos[$columna] = $this->$columna;
        }
        return $atributos; // array con los datos (columnas) de un modelo instanciado para crear o actualizar un registro en una tabla
    }

    // Sanitizar los datos antes de guardarlos en la BD
    public function sanitizarAtributos() {
        $atributos = $this->atributos(); // array con los datos de un registro a crear u actualizar (excepto el id)
        $sanitizado = [];
        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Sincroniza BD con Objetos en memoria
    public function sincronizar($args=[]) { 
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }

    // Registros - CRUD
    public function guardar() {
        if(!is_null($this->id)) {
            // actualizar
            $resultado = $this->actualizar();
        } else {
            // Creando un nuevo registro
            $resultado = $this->crear();
        }
        return $resultado;
    }

    // Todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla  ." WHERE id = ${id}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // Obtener Registros con cierta cantidad
    public static function get($limite) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ${limite}";
        $resultado = self::consultarSQL($query);
        return array_shift( $resultado ) ;
    }

    // SELECT en $tabla filtrando por la columna pasada por parametro
    public static function where($columna, $valor) {
        $query = "SELECT * FROM " . static::$tabla  . " WHERE $columna = '$valor'";
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // (VIDEO 534) Crea este metodo para poder hacer la consulta que necesita para el panel de administrador (que implica JOINS entre varias tablas)
    // este metodo nos sirve para hacer consultas a la base que no esten definidas entre los metodos con consultas "basicas" que ya tenemos en ActiveRecord (ActiveRecord::where(), ActiveRecord::guardar(), ActiveRecord::get(), etc)
    public static function SQL($query) {
        $resultado = self::consultarSQL($query);
        return $resultado;
    }

    // crea un nuevo registro
    public function crear() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        // Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($atributos)); // array_keys() genera un array con las keys del array asociativo pasado como parametro
        $query .= ") VALUES ('"; 
        $query .= join("', '", array_values($atributos)); // array_values() genera un array con los values del array asociativo pasado como parametro
        $query .= "')";

        // Resultado de la consulta
        $resultado = self::$db->query($query);
        return [
           'resultado' => $resultado,
           'id' => self::$db->insert_id
        ];
    }
    
    // Actualizar el registro
    public function actualizar() {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
        
        // Iterar para ir agregando cada campo de la BD
        $valores = [];
        foreach($atributos as $key => $value) {
            //$valores[] = "{$key}='{$value}'";
            $valores[] = "$key='$value'";
        }
        
        // Consulta SQL
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .=  join(', ', $valores );
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1"; 
        // Actualizar BD
        $resultado = self::$db->query($query);
        return $resultado;
    }

    // Eliminar un Registro por su ID
    public function eliminar() {
        $query = "DELETE FROM "  . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);
        return $resultado;
    }

}