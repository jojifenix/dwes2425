<?php
include "empleados.inc.php";

//gestion de Empleados

//foreach (HEADS as $h) echo $h.BR;  //las constantes se pueden usar como arrays

//puede venir de un $_POSTm $_FILES...
$path = "data";
$nomf = $path . "/emples.txt";


$f = fopen($nomf, "r");
//$fout = fopen($path . "/empleados.html", "w");

fclose($f); // Cerrar el archivo de entrada
//fclose($fout); // Cerrar el archivo HTML
