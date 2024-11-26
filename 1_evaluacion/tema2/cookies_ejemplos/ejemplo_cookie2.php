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
$d=date("d/m/Y h:i:s");
setcookie('ulti',$d);

if(!isset($_COOKIE['cont'])){

    setcookie('cont',1);
    printf("Nuevo en un lugar...<br/> Fecha actual: %s <br/> ", $d);
}else{
    setcookie('cont',$_COOKIE['cont']+1);
    printf("Nº visitas %s <br/> Última visita: %s <br/>",$_COOKIE['cont'],$_COOKIE['ulti']);
}

/*
Desde PHP no se puede borrar una cookie porque estñan en el navegador y no en el servidor.
Lo que se puede hacer es "caducarla", poniendo una caducidad anterior al momento actual.

setcookie('lang',time()-1);


*/
?>
</body>
</html>