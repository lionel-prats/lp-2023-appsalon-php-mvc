<?php

function debuguear($variable = 'nothing to debug') : string {
    echo "<pre>";
    //print_r($variable);
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML / recibe un string y lo retorna sanitizado (nos sirve para evitar la inyeccion SQL o ataques desde el cliente)
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// funcion que revisa que el usuario este autenticado (VIDEO 527)
// con :void especificamos que la funcion isAuth() no va a retornar nada -no es obligatorio, es una buena practica de escritura de codigo-
function isAuth() :void 
{
    if(!isset($_SESSION["login"])) { 
        // $_SESSION["login"] lo definimos en /controllers/LoginController->login(), una vez que el usuario se logueó (autenticó) correctamente}
        header("Location: /"); // si el visitante no esta logueado lo redirijo al login
    }
}