<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML / recibe un string y lo retorna sanitizado (nos sirve para evitar la inyeccion SQL o ataques desde el cliente)
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}