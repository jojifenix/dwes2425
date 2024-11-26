<?php

//El txt:

// 123|pepe
// pepe@hola.com
// ti|1|8.5K
// 232|ana
// ana@adios.com
// ti|2|10.0K
// 043|juan
// juan@como.es
// ventas|2|5,9K
// 234|ana
// ana@madrid.org adm|1|7.1K
// 765|luis
// luis@hola.es
// atc|2|6.0K


require_once "funciones.php"; // Incluir el archivo de funciones
require_once "empleados.php"; // Incluir el archivo de empleados

$path = "data";
$nomf = $path . "/emples.txt";

$aa = array(); // Array vacío para almacenar los alumnos
$a = array();

$f = fopen($nomf, "r");

// if (!$f) {
//     echo "No existe el archivo $nomf";
// } else {
//     // Leer la primera línea del archivo (cabeceras)
//     if (!feof($f)) {
//         $s = fgets($f);
//         $h = explode(", ", $s); // Guardar las cabeceras
//     }
// }

//No hay cabeceras en el archivo de texto
//Usamos las cabeceras del archivo empleados.php (HEADS)


// Procesar el resto de líneas (alumnos)
$cont = 0;

// while (!feof($f)) {

//     if ($cont % NUMLIN == 0) { // Primera línea (DNI y nombre)
//         $s = fgets($f);
//         $aux = explode(SEP, trim($s)); // Separar por '|' para DNI y nombre
//         $cont++;
//     } else if ($cont % NUMLIN == 1) { // Segunda línea (email)
//         $s = fgets($f);
//         $aux[] = trim($s); // Añadir el email como un nuevo campo al array
//         $cont++;
//     } else if ($cont % NUMLIN == 2) { // Tercera línea (departamento, nivel, salario)
//         $s = fgets($f);
//         $datos_finales = explode(SEP, trim($s)); // Separar por '|' los últimos 3 datos
//         foreach ($datos_finales as $dato) {
//             $aux[] = $dato; // Añadir cada uno al array aux
//         }

//         // Ahora que tenemos todos los campos (DNI, nombre, email, dpto, nivel, salario)
//         $a = array(); // Crear el array asociativo para este empleado
//         foreach ($aux as $k => $v) {
//             $a[HEADS[$k]] = $v; // Asignar cada campo al array con las claves de HEADS
//         }

//         // Usar el DNI como clave del array principal $aa
//         $aa[$aux[0]] = $a;
//         $cont++;
//     }

// }


    //manera de la profe:

    while (!feof($f)) {
        if ($cont%NUMLIN == 0)$s = fgets($f).SEP; //inicio de empleado
        else if ($cont%NUMLIN == NUMLIN - 1) {
            $s.=fgets($f);
            $aux = explode(SEP, trim($s));
            
            $al = [];
            foreach ($aux as $k => $v) {
                $al[HEADS[$k]] = $v; 
            }
    
            // Usamos el DNI como clave en el array principal
            $aa[$al[HEADS[0]]] = $al; 
        } else {
            $s.= fgets($f).SEP;
        } //solo acumular



        $cont++;
    }


print_r($aa); // Mostrar el array
echo BR.BR.BR;
echo BR . "Datos leídos" . BR;

$salida = tabla($aa, HEADS); // Generar las sentencias SQL o tabla
echo "Salida generada" . BR;
echo $salida; // Mostrar la salida

$fout = fopen($path . "/tabla.html", "w");
fwrite($fout, $salida); // Guardar la tabla en un archivo HTML

fclose($fout); // Cerrar el archivo HTML
fclose($f); // Cerrar el archivo de entrada
