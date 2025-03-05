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

    //print_r($_POST);

    define("MAX_CANT", 5000);
    define("VALS", ["dolar" => ["literal"=>"dólares", "tipo"=>1.16], 
                    "libra" => ["literal"=>"libras", "tipo"=>0.86], 
                    "yen" => ["literal"=>"yenes", "tipo"=>129.852], 
                    "leu" => ["literal"=>"lei", "tipo"=>4.87]]);
    $cant = $_POST["cant"];

    if (!is_numeric($cant) || $cant < 0) {
        echo "Error: la cantidad debe ser mayor que 0";
    } elseif ($cant > MAX_CANT) {
        echo "Error: la cantidad no puede ser mayor que " . MAX_CANT;
    } else {
        $mon = VALS[$_POST["moneda"]];
        $cambio = $cant * $mon["tipo"];
        echo "<p>" . $cant . " euros equivalen a " . $cambio . " " . $mon["literal"] . "</p>";
    }






    //MI FORMA:

    // if (empty($cant)) echo "Error: el campo cantidad es obligatorio";
    // elseif ($cant < 0) echo "Error: la cantidad no puede ser negativa";
    // else {
    //     if ($_POST["moneda"] == "dolar") {
    //         $cambio = $cant * 1.16;
    //         echo "<p>" . $cant . " euros equivalen a " . $cambio . " dólares </p>";
    //     } elseif ($_POST["moneda"] == "libra") {
    //         $cambio = $cant * 0.86;
    //         echo "<p>" . $cant . " euros equivalen a " . $cambio . " libras </p>";
    //     } elseif ($_POST["moneda"] == "yen") {
    //         $cambio = $cant * 129.852;
    //         echo "<p>" . $cant . " euros equivalen a " . $cambio . " yenes </p>";
    //     } elseif ($_POST["moneda"] == "leu") {
    //         $cambio = $cant * 4.87;
    //         echo "<p>" . $cant . " euros equivalen a " . $cambio . " lei </p>";
    //     }
    // }

    ?>
</body>

</html>