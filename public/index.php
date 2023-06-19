<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\APIController;
use Controllers\CitaController;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\ServicioController;

$router = new Router();

// iniciar sesion
$router->get("/", [LoginController::class, "login"]); 
$router->post("/", [LoginController::class, "login"]); 
$router->get("/logout", [LoginController::class, "logout"]); 

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
$router->get("/admin", [AdminController::class, "index"]);

// API de Citas
$router->get("/api/pruebas", [APIController::class, "pruebas"]);
$router->get("/api/servicios", [APIController::class, "index"]); // retorna los registros de la tabla "servicios"
$router->post("/api/citas", [APIController::class, "guardar"]); // endpoint que va a procesar las reservas de citas en el back (VIDEO 518)
$router->post("/api/eliminar", [APIController::class, "eliminar"]); // emdpoint para que el administrador pueda eliminar citas desde el panel de administrador

// CRUD de servicios (solo para el administrador) (empieza en el VIDEO 545)
$router->get("/servicios", [ServicioController::class, "index"]);
$router->get("/servicios/crear", [ServicioController::class, "crear"]);
$router->post("/servicios/crear", [ServicioController::class, "crear"]);
$router->get("/servicios/actualizar", [ServicioController::class, "actualizar"]);
$router->post("/servicios/actualizar", [ServicioController::class, "actualizar"]);
$router->post("/servicios/eliminar", [ServicioController::class, "eliminar"]);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();


