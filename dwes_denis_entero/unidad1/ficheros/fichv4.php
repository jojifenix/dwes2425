<?php

define("BR", "<br/>\n");

function tabla($datos)
{
    //genera una tabla a partir de un array de doble dimensión
    $tabla = "<table border=1>\n";
    $h = array_keys($datos[key($datos)]);

    // Generar la cabecera con todas las columnas
    $tabla .= "<thead><tr>";
    foreach ($h as $columna) {
        $tabla .= "<th>" . $columna . "</th>";
    }
    $tabla .= "</tr></thead>\n";

    // Generar las filas
    foreach ($datos as $a) {
        $tabla .= "<tr>";
        foreach ($a as $v) {
            $tabla .= "<td>" . $v . "</td>";
        }
        $tabla .= "</tr>\n";
    }

    $tabla .= "</table>\n";

    return $tabla;
}


$path = "data";
$nomf = $path . "/alumnos2.txt";

$aa = array(); // Array vacío para almacenar los alumnos
$a = array();

$f = fopen($nomf, "r");

if (!$f) {
    echo "No existe el archivo $nomf";
} else {
    // Leer la primera línea del archivo (cabeceras)
    if(!feof($f)) {   $s = fgets($f);
    $h = explode(", ", $s); // Guardar las cabeceras
    }
 

    // Procesar el resto de líneas (alumnos)
    while (!feof($f)) {
        $s = fgets($f); // Leer una línea nueva en cada iteración

        if (!empty(trim($s))) { //para comprobar q la linea no esta en blanco
            $aux = explode(", ", trim($s)); // Separar por comas y quitar espacios en blanco

            foreach ($aux as $k => $v) {
                $a[$h[$k]] = $v; // Asignar valores a las cabeceras correspondientes
            }

            $aa[$aux[0]] = $a; // Insertar en el array usando 'nia' como clave
        }
    }

    print_r($aa); // Mostrar el array de alumnos
    echo BR . "Datos leídos" . BR;

    $salida = tabla($aa); // Generar la tabla HTML
    //$salida = sql($aa, $h); // Generar las sentencias SQL
    echo "Salida generada" . BR;

    $fout = fopen($path . "/alumnos2.html", "w");
    fwrite($fout, $salida); // Guardar la tabla en un archivo HTML
    fclose($fout); // Cerrar el archivo HTML

    fclose($f); // Cerrar el archivo de entrada
}
