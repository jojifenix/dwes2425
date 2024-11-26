<?php
require_once "funciones.php"; // Incluir el archivo de funciones
require_once "empleados.php"; // Incluir el archivo de empleados

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
        $h = explode(", ", $s); // Guardar las cabeceras
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

print_r($aa); // Mostrar el array de alumnos
echo BR . "Datos leídos" . BR;

$salida = sql($aa, $h); // Generar las sentencias SQL o tabla
echo "Salida generada" . BR;
echo $salida; // Mostrar la salida

$fout = fopen($path . "/alumnos2.sql", "w");
fwrite($fout, $salida); // Guardar la tabla en un archivo HTML

fclose($fout); // Cerrar el archivo HTML
fclose($f); // Cerrar el archivo de entrada
