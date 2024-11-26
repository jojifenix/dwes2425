<!--ejer7_arr.php(el comentario se escribe asi porque esta zona es html--> 

<?php
/*
Se pueden declarar arrays especificando pares clave=>valor separados
por comas, entre llaves.

*/

$arr1= [
	0=> 444,
	1=> 222,
	2=> 333,
	7=> 111,
	"hola" => "que tal" //un índice puede ser una letra no debe ser siempre número
	];
	
$arr1[]= "otro";  //el índice lo pone PHP (el siguiente índice numérico del inmediatamente inferior ,teníamos 7)

echo"<br/>";
var_dump($arr1); //nos da más información que print_r (nos da el tipo (entero...) y el número de elementos del array


$arr1["fin"]="adiós";

$arr1[5]="cinco";
$arr1[]="nuevo"; //tendrá que ir después del índice 8 que fue creado por php en el ejemplo anterior osea éste tendrá índice 9

//la función print_r visualiza el array completo asi como var_dump pero este print_r da menos info
echo"<br/>";
print_r($arr1); /* al imprimir el resultado los nuevos componentes del array van después del último, 
aunque el indice que pongamos sea un numero que deberia ir entre otros indice numeros , 
al haberse escrito después va después */


$a=array("uno" , "dos" , 3 , 4 ); //índices numéricos consecutivos
echo"<br/>";
var_dump($a);


//el bucle foreach permite recorrer un array con mayor control

foreach($arr1 as $v) echo "<br/> $v, "; //visualiza solo los valores
foreach($arr1 as $k => $v){
	
	echo "<br/> la clave $k corresponde al valor $v <br/>";
}

//se puede declarar un array sin índices
$a= array(1, True, "c"); //asigna índices numéricos desde 0

echo"<br/>";
var_dump($a);	

//BORRAR elementos de un array... unset

unset($a[0]);
echo"<br/>";
var_dump($a);

echo"<br/>";
echo"$a[0]"; //lo acabo de borrar>> WARNING


echo"<br/>";echo"<br/>";echo"<br/>";echo"<br/>";echo"<br/>";echo"<br/>";echo"<br/>";
	






























