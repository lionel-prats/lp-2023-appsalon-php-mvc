<?php 

// autoload -> carga automaticamente las dependencias que descargué utilizando composer (VIDEO 556)
require __DIR__ . '/../vendor/autoload.php';

// instancia denpendencia instalada vlucas/phpdotenv
// como primer parametro le pasamos __DIR__, para indicar la ubicacion del .env (database.php y .env se encuentran en la misma ubicacion dentro del proyecto) (VIDEO 556)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

// con esta funcion prevenimos que nos marque error si el .ENV no existe (en el servidor de produccion no va a existir el .env, ya que las variables de entorno se van a inyectar por un a traves de un panel especial) (VIDEO 556)
$dotenv->safeload(); 


require 'funciones.php';
require 'database.php';


// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);