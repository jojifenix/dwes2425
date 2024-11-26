<!DOCTYPE html>
<!--En esta versión vamos a traducir en varios idiomas el caso anterior.Creamos el from_lang() en vistas. -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>

    <h2>Cambio de monedas e idiomas</h2>

   
<?php

include "data_monedatrad_vista/cambiotrad.vista.inc.php";

session_start();/*trabajar con una sesión .No podemos escribirlo despues de una salida html siempre va antes
osea que podemos escribirlo despues del body pero no despues de un <p> y echo , cosas asi+*/

//echo"<br/>".session_id(); para poder poner el id de session en pantalla

/*Si no destruimos las sesiones se mantienen en la siguiente visita*/
print_r($_SESSION);
echo BR;

if($_POST){

    if(isset($_POST['b_lang'])){// BOTÓN TRADUCIR
        //volver a imprimir toda la página, con el idioma seleccionado
        form_lang($_POST['lang']);
        form($_POST['lang']);
        //MEMORIZAR en la sesión el idioma seleccionado por el usuario(cuando pulsan el botón de traducir)
        $_SESSION['lang']=$_POST['lang'];
       
    }else{  //BOTÓN CAMBIAR
            if(validar($_POST["cant"]))
                mensaje($_SESSION['lang']/*$_POST['lang'] traduce en el primer momento pero cada vez
            que traducimos y queremos que se guarde el idioma último necesito la $_SESSION que almacena
            al pulsar cada botón*/,$_POST["cant"],VALS[$_POST["moneda"]]);
        }
}else{ //SIN BOTÓN

    /*DOS maneras de llegar
        al principio...GET INICIAL >> no hay sesión
        desde el <a> CONTINUAR >> si hay sesión*/

    //entrar por GET URL
    if(!isset($_SESSION['lang']))
    $_SESSION['lang']='es'; //SIEMPRE VA A HABER UN IDIOMA
    
        form_lang($_SESSION['lang']);
    form($_SESSION['lang']);
}



?>
</body>
</html>

