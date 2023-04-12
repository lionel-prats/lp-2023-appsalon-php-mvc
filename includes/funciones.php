<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML / retorna un string sanitizado
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}