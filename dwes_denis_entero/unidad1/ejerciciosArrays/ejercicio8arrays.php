<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    // 8. Dado el siguiente array asociativo multidimensional de credenciales donde las claves están
    // encriptadas en MD5

    // Supongamos un formulario de autenticación donde un usuario introduce como contraseña el valor
    // ‘clave2’ y la aplicación autenticó al usuario correctamente. Indicar el nombre y apellido del
    // usuario que introdujo tal contraseña.
    // Nota: md5(cadena en texto claro). 

    $credenciales = array(
        'ana' => array('nombre' => 'Ana', 'apellido' => 'García', 'clave' =>
        'a4a97ffc170ec7ab32b85b2129c69c50'),
        'marga' => array('nombre' => 'Margarita', 'apellido' => 'Ayuso', 'clave' =>
        '35559e8b5732fbd5029bef54aeab7a21'),
        'pepe' => array('nombre' => 'Jose', 'apellido' => 'González', 'clave' =>
        '10dea63031376352d413a8e530654b8b'),
        'luis' => array('nombre' => 'Luis', 'apellido' => 'Merino', 'clave' =>
        'C707dce7b5a990e349c873268cf5a968')
    );

    $busq = md5("clave2");
    print_r($busq);
    echo "<br/>";

    foreach ($credenciales as $user) {
        foreach ($user as $k => $n) {
            if ($busq == $n) {
                print_r($user["nombre"]);
                echo "<br/>";
                print_r($user["apellido"]);
            }
        }
    }

    ?>
</body>

</html>