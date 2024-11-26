<!-- Ejercicio calse -->

<?php
/*
1.-Crear un array $aa, vacío
2.-Leer alumnos txt linea a linea
3.-PARA CADA alumno(cada línea)
	1.-crear un array que contenga los datos del alumno con el siguiente formato
	["nia"=>1, "nombre" => "ana" , "ciclo"=> "daw"]
	2.-insertar el array  $a con los datos del alumno en $aa, con su nia como clave
4.-Generar un archivo alumnos.html que muestre todos los alumnos en una tabla

*/
define("BR", "<br/>\n");

$path = "data";
$nomf = $path . "/alumnos.txt"; // Archivo de entrada
$alumnosHtml = $path . "/alumnos.html"; // Archivo de salida (HTML)

$aa = []; // Array que almacenará los datos de los alumnos

// Abrir archivo de alumnos para lectura
$f = fopen($nomf, "r");

// Verificar si el archivo existe
if (!$f) {
    echo "No existe el archivo $nomf";
} else {
    // Leer el archivo línea por línea
    while (!feof($f)) {
        $s = fgets($f); // Leer una línea completa

        // Si la línea no está vacía, procesarla
        if (trim($s) !== '') {
            // Dividir la línea en partes separadas por ','
            $datos = explode(",", trim($s));

            // Crear array con los datos del alumno
            if (count($datos) == 3) {
                $nia = $datos[0];
                $nombre = $datos[1];
                $ciclo = $datos[2];

               
                $aa[$nia] = ["nia" => $nia, "nombre" => $nombre, "ciclo" => $ciclo];
            }
        }
    }
    fclose($f); 
}


$fhtml = fopen($alumnosHtml, "w");

/*// DATOS
define("BR", "<br/>\n");

// Puede venir de un $_POST, $_FILES...
$path = "data";
$nomf = $path . "/alumnos.txt";

$f = fopen($nomf, "r");
$fout = fopen($path . "/alumnos.html", "w");

if (!$f) {
    echo "No existe";
} else {
    $aa = array(); // Array vacío

    while (!feof($f)) {
        $s = fgets($f);

        // Asegurarse de que la línea no está vacía
        if (trim($s) != "") {
            $a = explode(", ", trim($s));

            // Asegurarse de que el array tiene exactamente 3 elementos
            if (count($a) == 3) {
                $al["nia"] = $a[0];
                $al["nombre"] = $a[1];
                $al["ciclo"] = $a[2];

                // Insertar los datos en el array $aa
                $aa[$a[0]] = array("nia" => $a[0], "nombre" => $a[1], "ciclo" => $a[2]);
            }
        }
    }

    // Imprimir el array para depuración (solo si contiene elementos)
    if (!empty($aa)) {
        print_r($aa);
    } else {
        echo "El archivo no contiene alumnos válidos" . BR;
    }
}

// Verificar si el array $aa tiene datos antes de generar la tabla
if (!empty($aa)) {
    // Generar la tabla en HTML
    $tabla = "<table border=1>\n";

    // Cabeceras de la tabla
    $h = array_keys($aa[key($aa)]);
    $tabla .= "<thead><tr><th>" . $h[0] . "</th><th>" . $h[1] . "</th><th>" . $h[2] . "</th></tr></thead>\n";

    // Rellenar la tabla con los datos de los alumnos
    foreach ($aa as $a) {
        $tabla .= "<tr>\n";
        foreach ($a as $v) {
            $tabla .= "<td>" . htmlspecialchars($v) . "</td>";
        }
        $tabla .= "</tr>\n";
    }

    $tabla .= "</table>" . BR;
    echo BR . "Salida generada" . BR;

    // Escribir la tabla en el archivo HTML
    fwrite($fout, $tabla);
} else {
    echo "No se generó ninguna tabla ya que no hay datos válidos." . BR;
}

// Cerrar los archivos
fclose($f);
fclose($fout);
*/
?>





