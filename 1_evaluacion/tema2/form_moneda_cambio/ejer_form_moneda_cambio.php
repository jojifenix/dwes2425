<!DOCTYPE html>
<!--En esta versión tenemosque quitar de las vistas la función formulario y quitar los dos monedas últimas
del archivo de cambio.inc.php-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>

    <h2>Cambio de monedas</h2>

    <form action='<?php echo $_SERVER['PHP_SELF']?>' method='POST'>
<!--Código embebido php dentro de html.-->
        <label>Cantidad de dinero:</label>
        <input type="number" name="cant" min=0 max=50000><br><br>

        <label>Selecciona una opción:</label>
            <select name="moneda">
                <option value="dolar">dolares</option>
                <option value="yen">yenes</option>
                <option value="yuan">yuanes</option>
                <option value="pesos">pesos argentinos</option>
                <br><br>
        <input type="submit" name= "CAMBIAR">
    </form>
   
<?php


//Código generado de php

include "data_moneda_vista/cambio.vista.inc.php";
//Hay que irse al archivo de vistas y cambiar el href con el código embebido de php que hace referencia a el mismo archivo

/*  Ahora si quiero admitir el GET..solo imprimirá el formulario.
    Si se hace por POST muestro el script.

    La semántica(significado) ha cambiado del ejercicio anterior con archivos separados y en este que todo
    está junto.

*/



if($_POST)//Si viene algo por $_POST calculo
    if(validar($_POST["cant"])){
        mensaje($_POST["cant"],VALS[$_POST["moneda"]]);
    }
 

?>
</body>
</html>

