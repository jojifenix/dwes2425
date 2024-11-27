<!DOCTYPE html>
<!-- mysqli_v0.php -->

<?php

/*
Ejemplo sencillo para comprobar que podemos conectar con una BD
mediante PDO
*/

//instanciar la conexion para un usuario concreto
$db = new mysqli("localhost:3306", "root", "root", "mysql");
if($db->connect_error){
    die("Error enla conexion : ".$db->connect_error);//si escribimos por ejemplo un nombre de base de datos que no exista
}
//consulta cualquiera para ver que estamos conectados
//Método fundamental es query que nos permite ejecutar una query cualquiera
if ($result=$db->query("SELECT * FROM db")) echo "Conectado";

$con= null; //eliminar la conexión


?>



