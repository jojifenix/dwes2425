<?php

/*1. Dados los dos siguientes arrays,
$a = array("manzana", "naranja”);
$b = array(1 => "manzana", "0" => "naranja");
Añadir dos nuevos elementos a ambos arrays: uno con el valor uva y otro con el valor mandarina.
Mostrar los nuevos resultados.
*/

$a= array("manzana", "naranja");
$b= array( 1=> "manzana", "0"=> "naranja");
$a[] = "uva";
$a[] = "mandarina";
$b[] = "uva";
$b[] = "mandarina";
foreach($a as $k=>$v) echo "Clave:$k...Valor:$v<br/>";
echo "<br/>";
foreach($b as $k=>$v) echo "Clave:$k...Valor:$v<br/>";

//2. Guardar las claves del array $b en otro array. Nota: array_keys.
$claves= array_keys($b);
echo "<br/>";
print_r($claves);

/*3. Ordenar:
a. descendentemente por clave el array $b anterior
b. ascendentemente por valor el array $b anterior.*/ 

echo "<br/>";
echo "<br/>";

krsort($b);
print_r($b);
echo "<br/>";
asort($b);
print_r($b);

/*4. A partir de $b obtener otro array con los mismos valores, pero con claves numéricas empezando
desde 0. Nota: array_values.*/ 


$j= array_values($b);
echo "<br/>";
echo "<br/>";
print_r($j);


/*5. Dada la cadena de caracteres “Desarrollo Web en Entorno Servidor con PHP”, construir un
array con cada palabra de la cadena anterior.
Nota: explode(separador, string, [limite]).*/ 

echo "<br/>";
echo "<br/>";
$cadena="Desarrollo Web en Entorno Servidor con PHP";
$palabras= explode(" ",$cadena, 7);
print_r($palabras);

/*6. Dado el array obtenido en el ejercicio anterior, obtener una cadena con sus elementos, pero
separados por el carácter ‘-‘. Debe salir “Desarrollo-Web-en Entorno-Servidor-con-PHP”.
Nota: implode(separador, string).*/ 

echo "<br/>";
echo "<br/>";
$palabras2= implode("-", $palabras);
print_r($palabras2);

/*7. Reemplazar el valor PHP de la cadena anterior por el valor JSP.
Nota: str_replace("cadena a buscar", "cadena de reemplazo",
cadenaOriginal).*/

echo "<br/>";
echo "<br/>";
$palabras3=str_replace("PHP","JSP",$palabras2);
print_r($palabras3);

?>