<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>

<h1>Cambio de monedas V1</h1>
    <?php

//                 V A L I D A C I O N E S     C R I S T I N A  


include "../formulario_moneda_cambio/data_moneda_vista/cambio.vista.inc.php";
 
if(!$_POST){
    error();
}else{
    if(validar($_POST["cant"])){
        mensaje($_POST["cant"],VALS[$_POST["moneda"]]);
    }
} 

?>



