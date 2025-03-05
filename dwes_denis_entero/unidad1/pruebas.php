<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    define("BR", "<br/>\n");
    $array = array(
        1 => "a",
        "1" => "b",
        1.9999 => "c",
        true => "d",
    );
    var_dump($array);

    echo "<br/><br/><br/><br/>";

    $cars = array(
        array("Volvo", 22, 18),
        array("BMW", 15, 13),
        array("Saab", 5, 2),
        array("Land Rover", 17, 15)
    );
    echo $cars[0][0] . ":
            In stock: " . $cars[0][1] . ",
            sold: " . $cars[0][2] . ".<br>";
    echo $cars[1][0] . ": In stock: " . $cars[1][1] . ",
            sold: " . $cars[1][2] . ".<br>";
    echo $cars[2][0] . ":
            In stock: " . $cars[2][1] . ",
            sold: " . $cars[2][2] . ".<br>";
    echo $cars[3][0] . ":
            In stock: " . $cars[3][1] . ", s
            old: " . $cars[3][2] . ".<br>";
    for ($i = 0; $i < count($cars); $i++) {
        echo $cars[$i][0] . ":
            In stock: " . $cars[$i][1] . ",
            sold: " . $cars[$i][2] . ".<br>";
    }

    echo "<br/><br/><br/><br/>";
    var_dump($cars);

    echo "<br/>";

    foreach ($cars as $car) {
        foreach ($car as $k => $v) {
            echo "$k...$v<br/>";
        }
    }


    //ESTRUCTURA TABLAS:

    $tabla = "<table border=10>";

    foreach ($cars as $car) {
        //comienzo de linea
        $tabla .= "<tr>" . BR;

        foreach ($car as $v) {

            $tabla .= "<td>$v</td>" . BR;
        }

        //fin de linea
        $tabla .= "</tr>" . BR;
    }

    $tabla .= "</table>";

    echo $tabla;
    ?>

    <?php

    ?>
</body>

</html>