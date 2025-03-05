<?php

if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
    die('CSRF');

    //esta solucion no sirve para pags iniciales donde se accede por get, 
    //porque estas no tienen referer.
    //Solo para paginas a las q se llega por POST, donde puede haber una 
    //cookie de identificador de usuario que pueda ser fake.

    //Ej de uso:

    //if ($_POST) {
    
    //    if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST'])
    //        die('CSRF');

//}