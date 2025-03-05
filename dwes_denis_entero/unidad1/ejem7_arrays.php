<!--ejer7_arr.php-->
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
	"hola" => "que tal" //los indices no tienen por q ser numéricos.
	];
	
$arr1[]= "otro";

echo"<br/>";
var_dump($arr1);

$arr1["fin"]="adiós";

$arr1[5]="cinco";
$arr1[]="nuevo";

//la función print_r visualiza el array completo
echo"<br/>";
print_r($arr1);

//el bucle foreach permite recorrer un array con mayor control

foreach($arr1 as $v) echo "<br/> $v, "; //visualiza solo los valores


foreach($arr1 as $k => $v){
	
	echo "<br/> la clave $k corresponde al valor $v <br/>";
}

foreach($arr1 as $k => $v){
	echo "
	<table border=1 cellpadding=15 width=300 heigth=100>
		<tr>
			<td style='background-color: red;'> la clave $k</td>
			<td style='background-color: blue;'> tiene el valor $v</td>
		</tr>
	</table>
	";
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
echo "".$a[1]; //lo acabo de borrar>> WARNING


echo"<br/>";echo"<br/>";echo"<br/>";echo"<br/>";echo"<br/>";echo"<br/>";echo"<br/>";
	






























