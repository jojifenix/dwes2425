<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    //Creamos las variables
    $v1 = NULL; // valor nulo
    $v2 = 0; // valor entero 0
    $v3 = 213; // valor entero != 0
    $v4 = "0"; // valor String 0
    $v5 = "feklnf"; //valor String != 0
    $v6 = ""; // valor String vacio
    $v7 = TRUE; //valor booleano true
    $v8 = FALSE; //valor booleano false


    //Las metemos en un array para iterar mejor
    $variables = [
        'v1' => $v1,
        'v2' => $v2,
        'v3' => $v3,
        'v4' => $v4,
        'v5' => $v5,
        'v6' => $v6,
        'v7' => $v7,
        'v8' => $v8,
    ];

    //Iteramos sobre el array y usamos isset() y empty()
    foreach($variables as $k => $v) {
        echo $k . " ... " . $v;
        echo "<br/>";

        if (isset($v)) {
            echo "isset() devuelve TRUE <br/>";
        } else {
            echo "isset() devuelve FALSE <br/>";
        }

        if (empty($v)) {
            echo "empty() devuelve TRUE <br/>";
        } else {
            echo "empty() devuelve FALSE <br/>";
        }
        echo "<br/>";
    }

    //Añadimos una posibilidad mas, en la que la variable no está declarada
    echo "v9 no declarada <br/>";
    if (isset($v9)) {
        echo "isset() devuelve TRUE <br/>";
    } else {
        echo "isset() devuelve FALSE <br/>";
    }

    if (empty($v9)) {
        echo "empty() devuelve TRUE <br/>";
    } else {
        echo "empty() devuelve FALSE <br/>";
    }

    //En conclusión: 
    // ·isset() devuelve FALSE si la variable es NULL o no está declarada, y TRUE en casos contrarios
    // ·empty() devuelve FALSE si la variable es un String o un entero no vacío distinto de 0, 
    //  o si es un booleano con valor TRUE, mientras que devuelve TRUE en caso de ser una variable
    // NULL, con valor 0 (ya sea String o entero), si es un String vacío, si es un booleano FALSE o 
    // si no está inicializado.
    ?>
</body>
</html>