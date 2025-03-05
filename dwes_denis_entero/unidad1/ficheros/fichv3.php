<!-- fichv1.php -->

<?php

//crear un array $aa, vacío
//leer alumnos txt linea a linea. Para cada linea:
// - Crear un array $a que contenga los datos del alumno con el siguiente formato:
//      ["nia" => 1, "nombre" => "ana", "ciclo"=>"daw"]
// - insertar el array con los datos del alumno en $aa, con su nia como clave
//generar un archivo alumnos.html que muestre todos los alumnos en una tabla

//pistas para extraer los datos de cada linea:
// - explode -> 
// - split -> 

define("BR", "<br/>\n");

function tabla($datos) {
    //genera una tabla a partir de un array de doble dimensión

    $tabla = "<table border=1>\n";
    $h = array_keys($datos[key($datos)]); 

    $tabla .= "<thead><tr><th>".$h[0]."</th><th>".$h[1]."</th><th>".$h[2]."</th></tr></thead>\n";

    foreach($datos as $a) {
        $tabla.="<tr>";
        foreach ($a as $v) {
            $tabla.="<td>".$v."</td>";
        }
        $tabla.="</tr>\n";
    }

    $tabla .= "</table>\n";

    return $tabla;
}

$path = "data";
$nomf = $path . "/alumnos.txt";

$aa = array(); //array[] es lo mismo
$a = array();

$f = fopen($nomf, "r");
//$fout = fopen($path . "/salida2.txt", "w");

$aux = array();

if (!$f) echo "No existe el archivo $nomf";
else {

    while (!feof($f)) {

        $s = fgets($f);
        //echo $s;
        //fwrite($fout, $s);

        $aux = explode(", ", $s); //separar por comas y espacio

        $al["nia"] = $aux[0];
        $al["nombre"] = $aux[1];
        $al["ciclo"] = $aux[2]; //manera de hacerlo de la profe

        $a = array("nia" => $aux[0], "nombre" => $aux[1], "ciclo" => $aux[2]);

        $aa[$aux[0]] = $a;
    }
    print_r($al); //no es un array con todos los datos, solo queda el ultimo.
    echo BR . BR;
    print_r($aa); //el array doble que se nos pide
    echo BR . BR;

    // $tabla = "<table border=1>\n";
    // $h = array_keys($al); //se cogen las array keys de al. Si se cogieran de aa, saldrían los nias (1, 2, 3)

    // $tabla .= "<thead><tr><th>".$h[0]."</th><th>".$h[1]."</th><th>".$h[2]."</th></tr></thead>\n";

    // foreach($aa as $a) {
    //     $tabla.="<tr>";
    //     foreach ($a as $v) {
    //         $tabla.="<td>".$v."</td>";
    //     }
    //     $tabla.="</tr>\n";
    // }

    // $tabla .= "</table>\n";

    $tabla = tabla($aa);
    echo "salida generada".BR;
    $fout = fopen($path . "/alumnos.html", "w");

    fwrite($fout, $tabla);

    //forma hecha por la profe. Genera la tabla en un archivo html





    // $tabla = "<table border=10>";
    // $tabla .= "<tr><th>NIA</th><th>Nombre</th><th>Ciclo</th></tr>";

    // foreach ($aa as $h) {
    //     $tabla .= "<tr>";
    //     $tabla .= "<td>";
    //     $tabla .= $h["nia"];
    //     $tabla .= "</td>";
    //     $tabla .= "<td>";
    //     $tabla .= $h["nombre"];
    //     $tabla .= "</td>";
    //     $tabla .= "<td>";
    //     $tabla .= $h["ciclo"];
    //     $tabla .= "</td>";
    //     $tabla .= "</tr>";
    // }

    // $tabla .= "</table>";

    // echo $tabla;
    //forma hecha por mi. Genera la tabla en el mismo documento php
    fclose($f);
}

