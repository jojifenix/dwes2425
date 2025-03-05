<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 de arrays</title>
</head>

<body>
    <!-- 1, 2, 3, 4, 5, 6 
     1. Dados los dos siguientes arrays,
        $a = array("manzana", "naranja”);
        $b = array(1 => "manzana", "0" => "naranja");
    Añadir dos nuevos elementos a ambos arrays: uno con el valor uva y otro con el valor mandarina.
    Mostrar los nuevos resultados.
    -->

    <?php



    $a = array("manzana", "naranja");
    $b = array(1 => "manzana", "0" => "naranja");

    $a[] = "uva";
    $a[] = "mandarina";

    $b[] = "uva";
    $b[] = "mandarina";

    foreach ($a as $fruta => $valor) {
        echo "Fruta: $fruta, Valor: $valor <br/>";
    }
    echo "<br/>";

    foreach ($b as $fruta => $valor) {
        echo "Fruta: $fruta, Valor: $valor <br/>";
    }
    echo "<br/>";

    // var_dump($a);
    // echo "<br/>";
    // var_dump($b);
    // echo "<br/>"; 

    // 2. Guardar las claves del array $b en otro array. Nota: array_keys. 

    $clavesB = array_keys($b);
    echo "Claves del array b: ";
    echo "<br/>";
    //var_dump($clavesB);
    foreach ($clavesB as $k => $v) {
        echo "Clave: $k, Valor: $v <br/>";
    }
    echo "<br/>";

    // 3. Ordenar:
    // a. descendentemente por clave el array $b anterior
    // b. ascendentemente por valor el array $b anterior. 

    krsort($b);
    echo "Descendentemente por clave: ";
    var_dump($b);
    echo "<br/><br/>";

    asort($b);
    echo "Ascendentemente por valor: ";
    var_dump($b);
    echo "<br/><br/>";

    // 4. A partir de $b obtener otro array con los mismos valores, pero con claves 
    // numéricas empezando desde 0. Nota: array_values

    $otroArray = array_values($b);
    echo "Array con mismos valores empezando desde 0: ";
    var_dump($otroArray);
    echo "<br/><br/>";

    //5. Dada la cadena de caracteres “Desarrollo Web en Entorno Servidor con PHP”, 
    //construir un array con cada palabra de la cadena anterior.
    //Nota: explode(separador, string, [limite]).

    $cadena = "Desarrollo Web en Entorno Servidor con PHP";
    $arrayCadena = explode(" ", $cadena);
    echo "Array con cada palabra de la cadena: ";
    var_dump($arrayCadena);
    echo "<br/><br/>";

    // 6. Dado el array obtenido en el ejercicio anterior, obtener una cadena con sus 
    //elementos, pero separados por el carácter ‘-‘. Debe salir 
    //“Desarrollo-Web-en Entorno-Servidor-con-PHP”.
    //Nota: implode(separador, string).

    $arrayCadena2 = implode("-", $arrayCadena);
    echo "Cadena con elementos separados por - : ";
    var_dump($arrayCadena2);
    echo "<br/><br/>";

    // PRUEBA
    // $cadenaPrueba = "  Desarrollo    Web en    Entorno    Servidor   con  PHP";
    // $arrayCadenaPrueba = explode(" ", $cadenaPrueba);

    // print_r($arrayCadenaPrueba);
    // no se puede usar explode para quitar espacios

    // 7. Reemplazar el valor PHP de la cadena anterior por el valor JSP.
    // Nota: str_replace("cadena a buscar", "cadena de reemplazo",cadenaOriginal). 
    echo "Cadena con PHP reemplazado por JSP: ";
    $cadena3 = str_replace("PHP", "JSP", $cadena);
    print_r($cadena3);


    ?>
</body>

</html>