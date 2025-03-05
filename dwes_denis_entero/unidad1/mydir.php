<?php
define("BR", "<br/>\n");
//muestra el contenido de un directorio

$midir = "img2"; //abre carpeta img desde el directorio actual del script
//C:\Denis\htdocs\unidad1

//si no existe:
// Warning: opendir(img2): El sistema no puede encontrar el archivo especifica (code: 2) in 
//C:\Denis\htdocs\unidad1\mydir.php on line 8

// Warning: opendir(img2): Failed to open directory: No such file or directory in 
//C:\Denis\htdocs\unidad1\mydir.php on line 8

if (is_dir(($midir))) { //comprueba si es un directorio

    if ($gestor = opendir($midir)) {
        echo "Gestor de directorio: $gestor\n";
        echo "Entradas:" . BR;

        /* Esta es la forma correcta de iterar sobre el directorio. */
        while (false !== ($entrada = readdir($gestor))) {
            echo "$entrada" . BR;
        }

        /* Esta es la forma errónea de iterar sobre el directorio. */
        while ($entrada = readdir($gestor)) {
            echo "$entrada" . BR;
        }
        //no funciona porque readdir() devuelve FALSE cuando se ha llegado al final del directorio
        //el puntero que recorre las entradas del directorio ya está al final,
        //por lo que no se puede volver a recorrer
        closedir($gestor);


        //aunque este vacio, se muestra "." y ".."
        //. es el directorio actual
        //.. es el directorio padre
    }
} else echo "El directorio $midir no se puede abrir" . BR;
