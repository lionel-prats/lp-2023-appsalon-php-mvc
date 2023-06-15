<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        // // lionel -> VIDEO 527
        // $rutas_protegidas = [
        //     "/cita"
        // ];

        // Proteger Rutas...
        // lionel -> al iniciar sesiones dentro de este metodo, dichas sesiones van a estar disponibles en cualquier tipo de peticion (GET o POST) que se le haga a la aplicacion, ya que este metodo se ejecuta necesariamente en TODAS las peticiones
        session_start();
        //debuguear($_SESSION);

        // // lionel -> VIDEO 527
        // $auth = $_SESSION["login"] ?? null;
        


        // Arreglo de rutas protegidas...
        // $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        // $auth = $_SESSION['login'] ?? null;

        $currentUrl = $_SERVER['PATH_INFO'] ?? '/';
        $method = $_SERVER['REQUEST_METHOD'];

        // // lionel -> VIDEO 527
        // if(in_array($currentUrl, $rutas_protegidas) && !$auth) {
        //     header("Location: /");
        // }


        // debuguear($method);
        if ($method === 'GET') {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        // $fn = ["Controllers\LoginController", "login"]
        // $this = object(MVC\Router){...} -> referencia a esta misma clase donde nos encontramos

        if ( $fn ) {
            // Call user fn va a llamar una función cuando no sabemos cual sera
            // lionel -> call_user_func( $funcionIncierta, $argumentosParaEsaFuncionIncierta ) es una funcion nativa de PHP que nos perrmite ejecutar una funcion de manera dinamica y pasarle argumentos tambien dinamicos  
            call_user_func($fn, $this); // pasamos $this como argumento para poder usar render() en los controladores
        } else {
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = [])
    {

        // Leer lo que le pasamos  a la vista
        foreach ($datos as $key => $value) {
            $$key = $value;  // Doble signo de dolar significa: variable variable, básicamente nuestra variable sigue siendo la original, pero al asignarla a otra no la reescribe, mantiene su valor, de esta forma el nombre de la variable se asigna dinamicamente
        }

        ob_start(); // Almacenamiento en memoria durante un momento...

        // entonces incluimos la vista en el layout
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpia el Buffer
        include_once __DIR__ . '/views/layout.php';
    }
}
