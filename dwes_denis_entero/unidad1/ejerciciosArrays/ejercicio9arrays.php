<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

// 9. Dado el siguiente array de variables globales, imprimir por pantalla 
// cada uno de sus elementos.  
// Ordenar ascendentemente el array $indicesServer del ejercicio anterior

$indicesServer = array('PHP_SELF',
'argv',
'argc',
'GATEWAY_INTERFACE',
'SERVER_ADDR',
'SERVER_NAME',
'SERVER_SOFTWARE',
'SERVER_PROTOCOL',
'REQUEST_METHOD',
'REQUEST_TIME',
'REQUEST_TIME_FLOAT',
'QUERY_STRING',
'DOCUMENT_ROOT',
'HTTP_ACCEPT',
'HTTP_ACCEPT_CHARSET',
'HTTP_ACCEPT_ENCODING',
'HTTP_ACCEPT_LANGUAGE',
'HTTP_CONNECTION',
'HTTP_HOST',
'HTTP_REFERER',
'HTTP_USER_AGENT',
'HTTPS',
'REMOTE_ADDR',
'REMOTE_HOST',
'REMOTE_PORT',
'REMOTE_USER',
'REDIRECT_REMOTE_USER',
'SCRIPT_FILENAME',
'SERVER_ADMIN',
'SERVER_PORT',
'SERVER_SIGNATURE',
'PATH_TRANSLATED',
'SCRIPT_NAME',
'REQUEST_URI',
'PHP_AUTH_DIGEST',
'PHP_AUTH_USER',
'PHP_AUTH_PW',
'AUTH_TYPE',
'PATH_INFO',
'ORIG_PATH_INFO') ;

asort($indicesServer);

foreach($indicesServer as $k => $v) {
    if (isset($_SERVER[$v])) {
    echo $k . " -----> " . $_SERVER["$v"];
    echo "<br/>";
    } else {
        echo "$v -----> No disponible en \$_SERVER<br/>";
    }
}


// 10. Indicar utilizando una función de librería de PHP si la variable global
// HTTP_USER_AGENT se encuentra en el array $indicesServer.
// Nota: in_array. 

if (in_array("HTTP_USER_AGENT", $indicesServer)) {
    echo "se encuentra";
} else {
    echo "no se encuentra";
}



    ?>
</body>
</html>