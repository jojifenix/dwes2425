<!DOCTYPE html>
<!-- "! + enter" genera documento html-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    DEFINE("BR","</br>\n");/*definimos un salto de línea tanto en el 
    código como en el documento html que generamos al final*/ 

    $array=array(1=>"a", "1"=>"b", 1.5=>"c", true=>"d");
    /*Array(clave1=>valor1, calve2=>valor2, ...).Considera el decimal 
    al 1, y los tipos los transforma a number de string, al ser 
    misma clave ahora, seleccionado el último valor dado */
    var_dump($array); //Muestra información de tipo y valor de las variable
    echo BR;//función que escribe en el documento html de salida salto de línea y 
    
    $arr=array();//array vacío
    $arr=array("A","B","C");//array con elementos
    $arr=array(1=>"España", 2=>"Francia", 3=> "Italia");//array asociativo
    $arr=array("es"=>"España", "fr"=>"Francia", "it"=>"Italia");/*array
    asociativo con claves*/
    $array=array("foo"=>"bar", "bar"=>"foo", 100=>-100, -100=>100);
    var_dump($array);
    echo "</br>";
    

    $array=array("foo","bar","hola","mundo");
    var_dump($array);
    echo BR;

    ?>
</body>
</html>