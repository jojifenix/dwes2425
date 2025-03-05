<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
 <title>ejercicio 4.3</title>
</head>
<body>
    COMPARATIVA PRINT Y ECHO <br/>

<?php

$mivar= 123;	//integer

print(gettype($mivar));

echo " $mivar ";

print(gettype($mivar));
echo gettype($mivar) . "hola";

echo "<br/>";

$mv= '3';  //string

print(gettype($mv));

$otra= 2*$mv;  //integer

echo " $mv ";

print(gettype($mv));

echo "<br/> $otra ";

$x= (string) $otra;	//integer

print(gettype($otra));


?>

</body>
</html>












