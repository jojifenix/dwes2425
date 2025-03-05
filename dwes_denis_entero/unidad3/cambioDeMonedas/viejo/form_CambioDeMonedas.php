<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario cambio de monedas</title>
    <style>
        form {
            margin: 0 auto;
            width: 200px;
            padding: 10px;
            border: 1px dashed black;
            border-radius: 10px;
            background-color: bisque;
        }

        input {
            padding: 5px;
            margin-bottom: 5px;
        }

        select {
            background-color: lightgrey;

        }

        .pphp {
            font-family: monospace;
            text-align: center;
            font-size: 1.5em;
        }

        .pform {
            text-align: center;
            margin-top: 5px;
            margin-bottom: 0px;
        }


        .enviar {
            margin-left: 65px;
            width: 70px;
            background-color: lightgrey;
        }

        .cant {
            width: 100px;
            margin-left: 45px;
            margin-top: 0px;
        }

        .div2 {
            margin-top: 10px;
        }
    </style>
</head>


<body>
    
</body>

</html>

<?php

//Crear un formulario con los siguientes elementos:
//   ·un campo cant para introducir una cantidad de dinero (hasta 5000) en euros
//   ·una lista desplegable con varias monedas inventadas
//   ·un botón con el texto "CAMBIAR"
//Al pulsar el botón se mostrará un mensaje para con el cambio de moneda
//Ej: "3000 euros equivalen a 3482,45 dólares".
//Validar que la cantidad sea un número no negativo

include("data/cambio.inc.php");
include("view/cambio.vista.inc.php");



// if ($_POST) {

//     if (validar($_POST["cant"])) {

//         mensaje($_POST["cant"], VALS[$_POST["moneda"]]);
//     }
// }

if($_POST){ //Si vienen por get enseñamos el formulario
    if(validar($_POST["cant"])){
        mensaje($_POST["cant"], VALS[$_POST["moneda"]]);
    }
}

?>