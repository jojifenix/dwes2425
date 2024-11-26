<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
 <title>ejercicio 4.3</title>
</head>
<body>

COMPARATIVA PRINT Y ECHO

<?php

$mivar= 123;	//integer
echo "<br/>";
echo "$mivar TIPO";
print(gettype($mivar)); //evalúa mientras que echo evalúa variable simples o string
echo "<br/>";

$mivar= "HOLA";	//integer
echo " $mivar TIPO";
print(gettype($mivar));


$mv= '3';  //string
echo "<br/> $mv TIPO";
print(gettype($mv));

$otra= 2*$mv;  //integer
echo "<br/>  $mv TIPO";
print(gettype($mv));

$otra=2*$mv; //integer

echo "<br/> $otra TIPO ";
print(gettype($otra));

$x= (string) $otra;	//integer

echo"<br/> $x TIPO";
print(gettype($x));


?>

</body>
</html>












