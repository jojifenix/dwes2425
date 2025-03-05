<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    //recibe un número y diga si es o no capicua

    $n = 101;
    echo "Número: $n<br/>";

    //extraer las cifras del número
    $cifras = array();

    for ($i = 0; $n >= 10; $i++) {
        $resto = $n % 10;
        $cifras[] = $resto;
        $n = ($n - $resto) / 10;
    }
    $cifras[] = $n;

    // for ($i = $n; $i >= 10; $i = ($i - $resto) / 10) {    
    //     $resto = $i % 10;
    //     $cifras[] = $resto;
    // }
    // $cifras[] = $n;

    print_r($cifras);
    echo "<br/>";


    // while($coc >=10) {
    //     $resto = $coc%10;
    //     $cifras[] = $resto;
    //     $coc = ($coc - $resto) / 10;
    // }
    // $cifras[] = $coc;


    // $i = 1;
    // $capicua = true;
    // foreach($cifras as $c) {
    //     if($c != $cifras[count($cifras)-$i]) {
    //         $capicua = false;
    //         break;
    //     }
    //     $i++;
    // }


    $capicua = true;
    for ($i = 0; $i < count($cifras) / 2; $i++) {
        //echo $cifras[$i] . $cifras[count($cifras) - $i - 1];
        if ($cifras[$i] != $cifras[count($cifras) - $i - 1]) {
            $capicua = false;
       }
    }

    if ($capicua==true) {
        echo "El número es capicua";
    } else {
        echo "El número no es capicua";
    }

    ?>
</body>

</html>