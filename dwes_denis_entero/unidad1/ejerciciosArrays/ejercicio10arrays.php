<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    // 11. Crear un array PHP que permita presentar en formato tabla HTML la siguiente relación de
    // películas. Seguidamente, ordenar la relación de películas por el nombre de la película y mostrar
    // la relación. Dado que se muestra la relación de películas dos veces, sería muy conveniente
    // implementar una función que reciba como parámetro el array y presente la información del array
    // en formato tabla HTML.

    // Nota: para ordenar un array multidmensional por una cierta clave se puede utilizar la
    // siguiente rutina:
    // foreach ($pelis as $clave => $fila) {
    // $nombre[] = $fila['nombre'];
    // $director[] = $fila['director'];
    // }
    // array_multisort($nombre, SORT_ASC, $director, SORT_ASC, $pelis); 

    $pelis = array(
        1 => array("Nombre" => "EL GOLPE", "Director" => "GEORGE ROY HILL"),
        2 => array("Nombre" => "LOS PAJAROS", "Director" => "ALFRED HITCHOCK"),
        3 => array("Nombre" => "SOSPECHOSOS HABITUALES", "Director" => "BRYAN SINGER"),
        4 => array("Nombre" => "PIRATAS DEL CARIBE: EL FIN DEL MUNDO", "Director" => "GORE VERBINSKI"),
        5 => array("Nombre" => "EL SEÑOR DE LOS ANILLOS: LA COMUNIDAD DEL ANILLO", "Director" => "PETER JACKSON"),
        6 => array("Nombre" => "WILLOW", "Director" => "RON HOWARD"),
        7 => array("Nombre" => "BRAVEHEART", "Director" => "MEL GIBSON"),
        8 => array("Nombre" => "LOS PAJAROS", "Director" => "AAL")
    );

    foreach ($pelis as $clave => $fila) {
        $nombre[] = $fila['Nombre'];
        $director[] = $fila['Director'];
    }
    array_multisort($nombre, SORT_ASC, $director, SORT_ASC, $pelis);
    //array_multisort — Ordena múltiples arrays o arrays multidimensionales
    //

    function tablaHTML($peliculas)
    {

        $tabla = "<table border=10>";
        $tabla .= "<tr><th>Código</th><th>Nombre</th><th>Director</th></tr>";

        foreach ($peliculas as $cod => $datos) {
            $tabla .= "<tr>";
            $tabla .= "<td>";
            $tabla .= $cod + 1;
            $tabla .= "</td>";
            foreach ($datos as $v) {

                $tabla .= "<td>";
                $tabla .= $v;
                $tabla .= "</td>";
            }
            $tabla .= "</tr>";
        }
        $tabla .= "</table>";

        echo $tabla;
    }

    tablaHTML($pelis);

    ?>
</body>

</html>