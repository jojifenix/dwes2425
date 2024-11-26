<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo_cookies
    </title>
</head>
<body>
    <?php
DEFINE("BR","<br/>\n");
//definir una cookie setcookie(k,v)


if(!isset($_COOKIE['lang'])){//si no existe cookie
    setcookie('lang','es');/*pide al servidor que la cree(el navegador de por si no puede crear solo) y 
    la envia al navegador(se almacena en el navegador)*/
    echo"There was upon a time...".BR;//mensaje en inglés
}else{ 
    echo "Las demás veces en español..\n".BR;//mensaje en español
    $_COOKIE['lang']="fr";//no funciona porque es variable del servidor
    /*
    No funciona porque la estoy cambiando el valor en el servidor pero la cookie sólo está en el navegador
    */

    //Para cambiar el valor de la cookie solo debo sobreesribirla.
    setcookie('lang','fr');
    echo"VALOR de la cookie lang...".$_COOKIE['lang'];
    /*
    Al utilizar la variable de servidor $_COOKIE['lang'], el servidor PIDE el valor de la cookie al navegador,
    que es quien la tiene.Por eso aunque cambiemos el valor de $_Cookie['lang'], no funciona
    , porque el servidor no devuelve el valor que tiene él, sino el valor que tiene el navegador.
    Para cambiar la cookie hay que hacerlo en el navegador
    si usamos var_dump saldran todas las cookies


    */
}

?>
</body>
</html>