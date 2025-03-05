<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Cambio monedas</title>
    <style>
        p {
            font-family: monospace;
            text-align: center;
            font-size: 1.5em;
        }
    </style>
</head>

<body>
    <?php

    //Crear un formulario con los siguientes elementos:
    //   ·un campo cant para introducir una cantidad de dinero (hasta 5000) en euros
    //   ·una lista desplegable con varias monedas inventadas
    //   ·un botón con el texto "CAMBIAR"
    //Al pulsar el botón se mostrará un mensaje para con el cambio de moneda
    //Ej: "3000 euros equivalen a 3482,45 dólares".
    //Validar que la cantidad sea un número no negativo

    require_once "data/cambio.inc.php";
    require_once "view/cambio.vista.inc.php";

    if (!($_POST)) { //si $_POST está vacío... ERROR
        error();
    } else {
    
        if (validar($_POST["cant"])) {

            mensaje($_POST["cant"], VALS[$_POST["moneda"]]);
        }
    }

    ?>
</body>

</html>