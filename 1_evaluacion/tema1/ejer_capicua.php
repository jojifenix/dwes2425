<?php

/*1. Programa que reciba un número y diga si es o no capicua*/

$n= 12341234;
print_r($n);
echo "<br/>";

//extraer las cifras del número (LÓGICA)
/*
$cifras = array();
$coc=$n;
$resto= $coc%10;
$cifras[]=$resto;

$coc=($coc-$resto)/10;
$resto= $coc%10;
$cifras[]=$resto;

print_r($cifras);*/

//ahora con bucle

$cifras = array();
$coc=$n;

while($coc>=10){
    $resto= $coc%10; //extraer cifras
    $cifras[]=$resto; //añadirla al array
    $coc=($coc-$resto)/10; //actualizar el coc
}

$cifras[]=$coc;
print_r($cifras);

//ahora iterar el array para comprobar cifra con cifra

$capi=true;

for ($i = 0; $i < sizeof($cifras) / 2; $i++) {
    if ($cifras[$i] != $cifras[sizeof($cifras) - 1 - $i]) {
        /*echo "El número no es capicúa";
        return; // Si en algún punto no coinciden, podemos detener el programa*/
        $capi= false;
    }
}


echo "capicua: $capi<br/>";//asi se imprimen booleanos



?>