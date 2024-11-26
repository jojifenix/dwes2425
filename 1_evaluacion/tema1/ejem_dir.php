<?php
define("BR", "<br/>\n"); 

$midir="img";
//opendir, closedir, readdir
//repasar if(is_dir($midir))???'
if ($gestor = opendir($midir)) {
    echo "Gestor de directorio: $gestor\n";
    echo "Entradas:".BR;
    /*El programa opendir abre el directorio declarado anteriormente como "img" , si existe.Nos muestra 
    su contenido , si no hubiera siempre muestra dos entradas que son "." y ".." , el "yo mismo" y el "directorio padre"*/
 
    /* Esta es la forma correcta de iterar sobre el directorio. */
    while (false !== ($entrada = readdir($gestor))) {
        echo "$entrada".BR;
    }
 
    /* Esta es la forma errónea de iterar sobre el directorio. */
    while ($entrada = readdir($gestor)) {
        echo "$entrada".BR;
    }
 
    closedir($gestor);//NO VUELVE A COLOCARSE EL PUNTERO AL PRINCIPIO YA QUE hay un closedir()
}else echo BR."El direcotorio $midir no existe".BR;
?>