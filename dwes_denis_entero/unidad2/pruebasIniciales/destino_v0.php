<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script de PHP</title>
</head>

<body>
    <h1>Envío de datos mediante formularios</h1>
    <?php
    /*
    Cuando el usuario envía datos a través de un formulario hacia el
    servidor, el servidor los almacena en forma de array. Existen varios
    arrays predeterminados en el servidor.
    $_POST
    $_GET
    $_REQUEST: sirve tanto para POST como GET
    */

    echo "Recibido...<br>";
    print_r($_POST);
    echo "<br><br>";

    // if(isset($_GET)) echo "GET<br>"; 
    // else echo "POST<br>";
    //Tanto $_GET como $_POST se declaran al mandar el formulario
    //No se puede usar isset

    if (empty($_GET)) echo "No hay datos en GET, se ha mandado por POST<br>";
    else echo "No hay datos en POST, se ha mandado por GET<br>";
    //La profe dice que tampoco se puede usar empty??? pero a mi me funciona

    if ($_GET) echo "GET<br>";
    else echo "POST<br>";
    //Dice que la manera correcta es esta. Un array vacío pasado a booleano
    //es false, por lo que si hay datos en GET, se ejecutará el if

    ?>
    <p>Recibido por GET: <?php print_r($_GET); ?></p>
    <p>Recibido por REQUEST: <?php print_r($_REQUEST); ?> </p>

    

</body>

</html>