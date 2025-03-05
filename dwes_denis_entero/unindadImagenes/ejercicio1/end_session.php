<?php
session_start();  //propagar la sesion para recuperar el phpsessid
session_unset();  //destruye el array en el servidor. Deja la cookie Libera memoria del servidor
session_destroy();  

header("Location: ejercicio1.php"); //lleva directamente a esta pagina
?>