<!DOCTYPE html>
<!-- pdo_v1.php -->

<?php

require_once('modelo\gesventa.inc.php');

/*Los datos vienen de un archivo de configuración*/

//1º paso: cadena de conexión con los datos de la BD
$connString= "mysql:host=".HOST."; dbname=".DB."; charset=".CHRST;

//2º paso: instanciar la conexión para un usuario concreto
$con = new PDO($connString, USER, PWD);

//configurar el modo de tratamiento de errores mediante excepciones
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo "Conectado";

$con= null; //eliminar la conexión


?>



