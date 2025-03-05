<?php

//require_once -> si hay un error en la carga del archivo, se detiene la ejecución
// y en caso de que se haya cargado previamente, no se vuelve a cargar

require_once '0defineBR.php'; // Define la constante BR
require_once '1funcionesVista.php'; // Define las funciones tabla y sql
require_once '2procesador.php'; // Procesa el archivo de texto. Como no tiene
                                // ninguna función, se ejecuta todo el código 
                                // que contiene de golpe 

//Es lo mismo ejecutar este script que ejecutar el script 2procesador.php
//Al ejecutar este script, se ejecuta el script 2procesador.php por el require_once

?>