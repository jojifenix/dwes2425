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





//INCLUDE
include "../formulario_moneda_cambio/data_moneda_vista/cambio.vista.inc.php";
/*Si escribimos una url en el navegador con los cambios hechos en php solo, escribiendo la ruta al archivo 
php nos da error ya que estamos pidiendo por método get(ya que escribimos nosotros la url) 
cuando el archivo sólo admite por método post por lo que hemos escrito antes.
Tenemos que pasar antes por el formulario 

Vamos a realizar en clase un mensaje de error con un enlace al formulario
*/
if(!$_POST){//si $_POST está vacío..ERROR

     //Manera más educada

    echo"<br/> Acceso incorrecto";
    echo"<br/><a href='ejer_form_moneda.html'> CONTINUAR </a>";
    

    /*header("Location:ejer_form_moneda.html");//Manera más directa
    die();*/


    
}else{

$cant=$_POST["cant"];//sólo admito datos por post
//VALIDACIONES
if(!is_numeric($cant)||$cant<0)
    echo"<br/> la cantidad debe ser mayor que cero";
elseif($cant>MAX_CANT)
    echo"<br/> la cantidad máxima es".MAX_CANT;
else{
    $mon=VALS[$_POST["moneda"]];//Coge de VALS toda la fila de la moneda escogida
    $cambio=$cant*$mon["tipo"];
    echo "<br/> $cant EUROS equivalen a $cambio".VALS[$_POST["moneda"]][0];
}   

}




?>



