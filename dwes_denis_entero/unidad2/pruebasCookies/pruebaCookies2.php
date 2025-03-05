<?php

define("BR", "<br>\n");

$d = date("d/m/Y h:i:s");
setcookie('ulti', $d);

if (!isset($_COOKIE['cont'])) {
    setcookie('cont', 1);
    printf("Nuevo en el lugar ... <br/> Fecha actual: %s <br/>", $d);
} else {
    setcookie('cont', $_COOKIE['cont'] + 1);
    printf("Nº visitas %s <br/> Última visita: %s <br/>", $_COOKIE['cont'], $_COOKIE['ulti']);
}
/*Desde PHP no se puede borrar una cookie porque está en
el navegador y no en el servidor. Lo que se puede hacer es 
"caducarla" poniendo un tiempo de vida negativo.

*/
//setcookie('cont', '', time()-1);