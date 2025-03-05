<!--ejem8_bool.php-->

<?php

/*
al ser PHP débilmente tipado, cualquier variable puede ser interpretada 
como boolean, pero esto puede ser peligroso porque las conversiones nos
pueden dar algún susto.
Para mayor seguridad en las comparaciones, usar el operador ===
*/
define("BR", "<br/>\n");

$v1= -5;
if($v1) echo "$v1 es TRUE".BR; //imprime
if($v1===true) echo "$v1 es TRUE".BR; //no imprime
// === primero comprueba si los tipos son iguales

$v0= 0;
if(!$v0) echo "$v0 es FALSE".BR; //imprime
if($v0 !== true) echo "$v0 es FALSE".BR; //imprime

$s0="";
if(!$s0) echo "String vacío es FALSE".BR; //imprime
if($s0=== false) echo "String vacío es FALSE".BR; //no imprime

$s0="0";
if(!$s0) echo "$s0 es FALSE".BR; //imprime

$s="1kjsah lh";
if($s) echo "String NO vacío es TRUE".BR; //imprime

$a= array();
if(!$a) echo "Array VACÍO es FALSE".BR;  //imprime

$n= NULL;
if(!$n) echo "$n NULL es FALSE".BR; //imprime

if($s===true) echo "String es TRUE".BR; //no imprime


//Conclusion: 
// el === compara tipos y valor, == compara solo valor.
// numero 0, string "0", string vacio, array vacio o NULL es FALSE
// numeros != 0, string no vacio es TRUE.










