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


if($_POST){

    if(isset($_POST['b_lang'])){//traducir
        //volver a imprimir toda la página, con el idioma seleccionado
        form_lang($_POST['lang']);
        form($_POST['lang']);
    
       
    }else{
            if(validar($_POST["cant"]))
                mensaje($_POST['lang'],$_POST["cant"],VALS[$_POST["moneda"]]);
        }
}else{
    form_lang();
    form();
}

?>
</body>
</html>

