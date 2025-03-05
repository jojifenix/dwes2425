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

    //Antes de trabajar con los datos, se pueden hacer VALIDACIONES
    //AUNQUE es más eficiente hacerlas en el cliente que en servidor

    print_r($_POST);
    echo "<br><br>";

    // if (empty($_POST["nombre"])) echo "Error: el campo nombre es obligatorio";
    // elseif (empty($_POST["pwd"])) echo "Error: el campo contraseña es obligatorio";
    // elseif (empty($_POST["email"])) echo "Error: el campo email es obligatorio";
    // else echo "Datos correctos";
    //Es correcto pero es tedioso. Se puede hacer con un bucle

    echo "<br><br>";

    //Recorrer el array POST

    $kk = array_keys($_POST);
    $datos = true;

    foreach ($kk as $k)
        if (empty($_POST[$k])) {
            $datos = false;
            echo "<br>Error: el campo $k es obligatorio<br>";
            break;        //salgo del bucle
        }

    if ($datos) echo "<br>Datos correctos";

    //VALIDACIONES
    //filter_var permite limpiar cualquier caracter no deseado en los datos de entrada
    //y ademas validar el tipo de datos.

    $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST["pwd"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    echo "<br>Nombre: $nombre";
    echo "<br>Contraseña: $pwd";
    echo "<br>Email: $email";

    //FILTER_SANITIZE_URL
    //FILTER_SANITIZE_NUMBER_INT

    //Cuando decimos que es mejor validar en cliente, es porque con estas funciones 
    //se mandan las validaciones al servidor y es mejor no cargarlo.
    //Sería mejor hacerlo en cliente con JS.


    ?>

</body>

</html>