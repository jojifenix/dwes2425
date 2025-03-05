<?php
require_once '0defineBR.php';
require_once '1funcionesVista.php';

//El objetivo de este .php es leer el txt y guardar los datos en el array $aa. 
// $aa es un array de arrays cuyas claves son el primer dato de la 
// línea del txt. Por ejemplo, si el txt es:
// 1, Pepe, 25
// 2, Juan, 30
// $aa sería:
// [1] => [1, Pepe, 25]
// [2] => [2, Juan, 30]

$path = "data";
$nomf = $path . "/empleados.txt";

$aa = array(); // Array vacío para almacenar los alumnos
$a = array();

$f = fopen($nomf, "r");

if (!$f) {
    echo "No existe el archivo $nomf";
} else {
    // Leer la primera línea del archivo (cabeceras)
    if (!feof($f)) {
        $s = fgets($f);
        $h = explode(", ", $s); // Guardar las cabeceras en $h
    }
} 

// Procesar el resto de líneas (alumnos)
while (!feof($f)) {
    $s = fgets($f); // Leer una línea nueva en cada iteración

    if (!empty(trim($s))) { // Para comprobar que la línea no está en blanco
        $aux = explode(", ", trim($s)); // Separar por comas y quitar espacios en blanco

        foreach ($aux as $k => $v) {
            $a[$h[$k]] = $v; // Asignar valores a las cabeceras correspondientes
        }

        $aa[$aux[0]] = $a; // Insertar en el array usando 'nia' como clave
    }
} 

//Aquí termina el procesamiento del .txt. A continuación se muestra el array 
//resultante, se llama a la función tabla o a la función sql y se guarda la salida en un 
//archivo ("/sentencia.sql" actualmente).
//-------------------------------------------------------------------------------------------

print_r($aa); // Mostrar el array de alumnos
echo BR . "Datos leídos" . BR;

$salida = tabla($aa); // Generar la tabla
//$salida = sql($aa, $h); // Generar las sentencias SQL
echo "Salida generada" . BR;
echo $salida; // Mostrar la salida

$fout = fopen($path . "/sentencia.html", "w");
fwrite($fout, $salida); // Guardar la tabla en un archivo HTML

fclose($fout); // Cerrar el archivo HTML
fclose($f); // Cerrar el archivo de entrada
