<!DOCTYPE html>
<!--En esta versión hemos puesto más monedas liras turcas, pesos mexicanos etc en el archivo de cambio.inc.php
También hemos añadido la función form() dentro de cambio.vista.inc.php , y también cambiamos en el archivo 
cambio.vista.inc.php la manera de la función form() ya que hacemos echo del html formulario pero la parte de 
las opciones la hacemos con php, cerramos el echo y al terminar el php volvemos a hacer echo para terminar el 
html del formulario.Estamos generando una manera de realizar el formulario dinámica ya que al añadir más monedas
se actualiza.

Lo que conseguimos es que las opciones del formulario se actualicen con solo añadir monedas -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>

    <h2>Cambio de monedas</h2>

   
<?php

include "data_moneda_vista/cambio.vista.inc.php";
/*Si viene algo por $_POST calculo.Pero pinta también formulario , queremos que no pinte el formulario.
AAntes el form() estaba fuera del condicional dentro del php , entonces siempre imprime form() y después según 
el array $_POST esté vacío o no hace la ejecución del php de esa parte.Pero ahora en el condicional hacemos que solo
se imprima al estar vacío el array pero al enviar el formulario ahora está lleno el array , nos lleva al mismo
archivo y al leer el if vemos que está lleno el array asi que no imprime formulario ejecuta el if de $_POST lleno*/
if($_POST){
    if(validar($_POST["cant"]))
        mensaje($_POST["cant"],VALS[$_POST["moneda"]]);
    }else form();
 

?>
</body>
</html>

