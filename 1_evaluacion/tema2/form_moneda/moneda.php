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



/*LOS SUYOS SON CON OTROS DATOS EN EL HTML CUIDADO, PERO VIENEN MAS COSAS QUE SON NECESARIAS, CAMBIAR CON MIS
DATOS LOS VALORES SOLO.*/

//constantes y print_r
DEFINE("MAX_CANT",50000);
DEFINE("VALS",["dolar"=>["dolares",1.03],
               "yen"=>["yenes",1.28],
               "yuan"=>["yuanes",0.96],
               "pesos"=>["pesos argentinos",223.98]]);

print_r($_POST);

$cant=$_POST["cant"];

//validaciones
if(!is_numeric($cant)||$cant<0)
    echo"<br/> la cantidad debe ser mayor que cero";
elseif($cant>MAX_CANT)
    echo"<br/> la cantidad máxima es".MAX_CANT;
else{
    $cambio=$cant*VALS[$_POST["moneda"]][1];
    echo "<br/> $cant EUROS equivalen a $cambio".VALS[$_POST["moneda"]][0];
}   




//                    V A L I D A C I O N E S                J O R D I




/*

print_r($_POST);
$inicio=$_POST["cant"];
$final=$_POST["monedas"];

if($final=="Dólares"){
    $conversión=$inicio*1.09;
    echo "<br/><br/>La cantidad de $inicio euros equivale a $conversión $final";
}elseif($final=="Yenes"){ 
    $conversión=$inicio*162.59;
    echo "<br/><br/>La cantidad de $inicio euros equivale a $conversión $final";
}elseif($final=="Rupias"){
    $conversión=$inicio*91.66;
    echo "<br/><br/>La cantidad de $inicio euros equivale a $conversión $final";
};


*/

    ?>
</body>
</html>