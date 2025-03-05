<?php
include("view/cambiotrad.vista.inc.php");
session_start();  //propagar la sesion para recuperar el phpsessid
session_unset();  //destruye el array en el servidor. Deja la cookie Libera memoria del servidor
session_destroy();  

header("Location: form_CambioDeMonedasTrad.php"); //lleva directamente a esta pagina
?>

<!-- session_unset(): Solo elimina las variables de la sesión actual, pero la sesión permanece activa.
    session_destroy(): Destruye la sesión en el servidor, pero no elimina automáticamente la cookie en el cliente.

Si lo que deseas es reiniciar completamente la sesión (tanto en el servidor como en el cliente), lo ideal es usar ambas:

    session_unset() para vaciar las variables.
    session_destroy() para eliminar la sesión en el servidor.
    setcookie() para eliminar la cookie de sesión en el navegador. -->