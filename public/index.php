<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\LoginController;

$router = new Router();

// iniciar sesion
$router->get("/", [LoginController::class, "login"]); 
$router->post("/", [LoginController::class, "login"]); 
$router->post("/logout", [LoginController::class, "logout"]); 

// recuperar password 
$router->get("/olvide", [LoginController::class, "olvide"]); 
$router->post("/olvide", [LoginController::class, "olvide"]); 
$router->get("/recuperar", [LoginController::class, "recuperar"]); 
$router->post("/recuperar", [LoginController::class, "recuperar"]); 

// crear cuenta
$router->get("/crear-cuenta", [LoginController::class, "crear"]); 
$router->post("/crear-cuenta", [LoginController::class, "crear"]); 

// confirmar cuenta
$router->get("/confirmar-cuenta", [LoginController::class, "confirmar"]); 
$router->get("/mensaje", [LoginController::class, "mensaje"]); 

// AREA PRIVADA 
$router->get("/cita", [CitaController::class, "index"]);

// API de Citas
$router->get("/api/pruebas", [APIController::class, "pruebas"]);
$router->get("/api/servicios", [APIController::class, "index"]);
$router->post("/api/citas", [APIController::class, "guardar"]); // endpoint que va a procesar las reservas de citas en el back (VIDEO 518)

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();


