<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario cambio de monedas</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>


<body>
    <?php

    include("data/cambio.inc.php");
    include("view/cambio.vista.inc.php");

    //if (!$_POST) form();

    //else...
    if ($_POST) { //Si vienen por get enseñamos el formulario
        if (validar($_POST["cant"])) {
            mensaje($_POST["cant"], VALS[$_POST["moneda"]]);
        }
    } else form();

    ?>
</body>

</html>