<html>
<body>
<?php
DEFINE("BR","</br>\n");//CONSTANTE
$array = array(
1 => "a", "1" => "b", 1.5 => "c", true => "d"); //indice aunque sea entre comillas lo interpreta como número
//el 1.5 lo reconoce como 1 y true al final transforma en 1 acordarse que false es 0.
var_dump($array);

$array = array(
    "foo" => "bar", "bar" => "foo", 100 => -100, -100 => 100,
    );

echo BR;
foreach($array as $k=>$v) echo "$k..$v\n"; //navegador solo interpreta </br> pero los \n interpreta el fichero de texto solo.
// \n no es etiqueta de html.
echo BR;//USANDO BR tenemos la variable que añade salto de linea al navegador y al fichero en si para el programador.
var_dump($array);

//SI SE PUEDE PONER NÚMERO NEGATIVO COMO ÍNDICE EN ARRAYS






$a = array(1 => 'uno', 2 => 'dos', 3 => 'tres');
unset($a[2]);
/* producirá un array que se haya definido como
$a = array(1 => 'uno', 3 => 'tres');
y NO $a = array(1 => 'uno', 2 =>'tres'); */
$b = array_values($a);
// Ahora $b es array(0 => 'uno', 1 =>'tres')
//creamos un nuevo array con los valores del array referenciado pero de índices consecutivos desde 0

$b=array_values($array);
echo BR;
var_dump($b);






//COPIA DE ARRAYS POR VALOR

$arr1 = array("uno","dos");
$arr2 = $arr1; 
$arr2[] = 4;
// $arr2 ha cambiado,
// $arr1 sigue siendo array(2, 3)
echo BR;
print_r($arr1);
echo BR;
print_r($arr2);

//COPIA POR REFERENCIA

$arr3 = &$arr1; 
$arr3[] = 4;
unset($arr1[0]);
echo BR;
print_r($arr1);
echo BR;
print_r($arr3);
// ahora $arr1 y $arr3 son iguales. Cualquier cambio en uno, se
//refleja automáticamente en el otro.




//ORDENAR ARRAYS (la funciones se tragan los arrays como argumentos)
/*sort(); //orden ascendente (por valor no por clave)
rsort(); // orden inverso
asort();// ordena arrays asociativos por valores(acendente)
ksort(); //ordena arrays asociativos por clave(ascendente)
arsort(); 
krsort(); */



//ARRAYS MULTIDIMENSIONALES (TENEMOS ARRAY DE ARRAYS)

echo BR;
$cars = array(
            array("Volvo",22,18),
            array("BMW",15,13),
            array("Saab",5,2),
            array("Land Rover",17,15)
            );

echo "Modelo: ".$cars[0][0].BR."Stock: ".$cars[0][1].BR."Vendidos: ".$cars[0][2].BR;
print_r($cars[0]);
echo BR;
print_r($cars);
  
//ITERAR DOBLE BUCLE

foreach($cars as $car){
    echo "Modelo: ".$car[0].BR."Stock: ".$car[1].BR."Vendidos: ".$car[2].BR;
}

foreach($cars as $car)
    foreach($car as $k=>$v){
        echo"$k..$v".BR;}


//TABLAS

$tabla="<table border=1>";
    foreach($cars as $car){
        //comienzo de linea
        $tabla.="<tr>";//imporante el .= porque si no sustituye el valor con = , el punto es para añadir

        foreach($car as $v){
            $tabla.="<td>$v</td>";
            }

        //fin de linea
        $tabla.="</tr>";

    }
$tabla.="</table>".BR;
echo $tabla;

?>