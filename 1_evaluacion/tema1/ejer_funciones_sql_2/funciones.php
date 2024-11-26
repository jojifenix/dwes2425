<?php
require_once "empleados.php";

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

function sql($datos, $head)
{
    // Recibe un array de datos y otro con nombres de campos
    // Genera, para cada fila del array $datos, una sentencia SQL INSERT
    $sql = "";
    $datosSeparados = array();

    foreach ($datos as $k => $v) {
        $sql .= "INSERT INTO emple (";
        $sql .= trim(implode(", ", $head));
        $sql .= ") VALUES (";

        foreach ($v as $k2 => $v2) {
            if (is_numeric($v2)) {
                $datosSeparados[] = $v2;
            } else {
                $datosSeparados[] = "'" . $v2 . "'";
            }
        }

        $sql .= implode(", ", $datosSeparados) . ");\n";
        $datosSeparados = array();
        $sql .= BR;
    }
    return $sql;
}
