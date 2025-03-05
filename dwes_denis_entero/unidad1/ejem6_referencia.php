<?php

/* copia de variables por VALOR */
$v1= 100;
$v2= $v1; //asignación: copia de valor y de tipo
echo "<br/> $v1";	//100
echo "<br/> $v2";	//100

echo "<br/>";
//modificamos $v1 a ver qué pasa
$v1= 500;
echo "<br/> $v1";	//500
echo "<br/> $v2";	//100
//$v2 copió el valor que tenía $v1 en su momento pero ahora no

echo "<br/>";
/*copia de variables por REFERENCIA */
$v2= &$v1;
echo "<br/> $v1"; 	//500;
echo "<br/> $v2"; 	//500;

echo "<br/>";
$v1= 375;
echo "<br/> $v1"; 	//375;
echo "<br/> $v2"; 	//375;

//ahora al cambiar el valor de $v1 cambia también el de $v2
//porque el valor de $v2 es la referencia de $v1 >> están ligadas
//ADEMÁS, estas variables quedan ligadas y si cambio una
//cambia la otra

echo "<br/>";
$v2= 5;
echo "<br/> $v1"; 	//5
echo "<br/> $v2";	//5

echo "<br/>";
unset($v2); //destruye la variable de la pila
echo "<br/> $v1"; 	//5
if (isset($v2)) echo "<br> $v2";	//5 ---- isset te dice si existe
else echo "<br/>la variable no existe";





