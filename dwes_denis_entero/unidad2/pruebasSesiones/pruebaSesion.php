<?php
session_start(); 

$d = date("d/m/Y h:i:s");

if (!isset($_SESSION['cont'])) {
    $_SESSION['cont'] = 1;
    printf("Nuevo en el lugar ... <br/> Fecha actual: %s <br/>", date("d/m/Y h:i:s"));
} else {
    $_SESSION['cont']++;
    printf("Nº visitas %s <br/> Última visita: %s <br/>", $_SESSION['cont'], $d);
}
//se ha de usar para poder acceder a 
//las variables de sesión Ha de hacerse antes de 
//cualquier salida al navegador (HTML, etc.)