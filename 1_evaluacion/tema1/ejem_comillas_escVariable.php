<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>ejercicio 4.2</title>
    </head>
<body>

<?php
$n1=1;
$n2=2;
$suma=$n1+$n2;
$concat=$n1.$n2;
echo "suma = ".$suma. "<br/>";
//comillas mágicas ""... las variables con valor SIMPLE se interpretan dentro del echo
echo "suma = $suma <br/>";
echo "$n1+$n2<br/>";
//ESCAPAR VARIABLES ( al añadir la barra \ le decimos que interprete como una letra no como carácter especial)
echo "\$n1+\$n2<br/>";
//COMILLAS SIMPLES (no son mágicas)
echo '$n1+$n2<br/>';
//ESCAPAR COMILLAS ( le decimos con la barra inclinada que imprima la comilla y que no la interprete)
echo "\"hola\"<br/>";

?>
</body>
</html>












