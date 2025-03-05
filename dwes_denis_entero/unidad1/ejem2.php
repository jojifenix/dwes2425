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
$concat= $n1.$n2;
echo "suma = ".$suma. "<br/>";
echo "concatenacion = ".$concat. "<br/>";
//comillas mágicas ""... las variables con valor simple se interpretan dentro del echo
echo "suma = $suma <br/>";
echo "$n1+$n2<br/>";

echo "Escapar variables <br/>";
echo "\$n1+\$n2<br/>";

echo "Comillas simples <br/>";
echo '$n1+$n2<br/>';

echo "Escapar comillas <br/>";
echo "\"hola\"<br/>";

?>
</body>
</html>












