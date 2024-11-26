
<!--Reutilizando el ejercicio de visualización de imágenes, generar una aplicación que haga lo siguiente:

1. Al iniciarse mostrará:
    a) un formulario de login y debajo
    b) un elemento select 'fila' que permita elegir un numero del 2 al 5
    c) una tabla con las imágenes que haya en un directorio public, que tenga en cada fila el numero de imagenes que se hayan seleccionado en 'fila'
    d) una vez que se haya seleccionado una opción de visualización, deberá mantenerse la opción elegida aunque se vaya a otras páginas de la app

2. validará los usuarios contra un archivo (se puede reutilizar el ejercicio anterior).Al validar a un usuario:
    a) si no tiene una carpeta propia, se creará. La carpeta tendrá el mismo nombre que el usuario.
    b) el form de login se sustituirá por
        i) un form para subir nuevas fotos a la carpeta del usuario: solo se admitirán png, gif y jpg. Sise sube una nueva foto, mandtendrá el nombre de origen añadiendo fecha y hora.
        i.2)Opcionalmente un form de traducción para las preferencias de idioma
        ii) Un enlace de desconexión que tenga una imagen de tipo botón. Al desconectar, se reiniciara al app eliminando cualquier preferencia o elemento del usuario
    c) se mantendrá el form para cambiar la visualización
    

No es para este ejercicio pero ten en cuenta los ataques CSRF al crear las aplicaciones web
tenemos métodos como el token, como $_SERVER['HTTP_REFERER'] , REMOTE_HOST (consultar manual php).
En la entrega tenemos la definición también (como dato adicional).
-->

<!DOCTYPE html>
<!-- fotos_app_trad.php
    app de gestión de fotos con TRADUCCIÓN
-->
<?php
session_start(); 
if(!isset($_SESSION["lang"])) $_SESSION["lang"]= 'es';
if(!isset($_SESSION["layout"])) $_SESSION["layout"]= 4;
if(!isset($_SESSION["lang"])) $_SESSION["lang"]= 'public'; //no es seguro

?>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>

<body>
   
<?php
include ("cambio/cambio.php");
include ("vista/fotos.trad.vista.inc.php");


cabecera();

if($_POST){ //por $_POST... han pulsado algún BOTÓN

    if(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)!= $_SERVER['HTTP_HOST'])
	die('CSRF');

    if(isset($_POST['b_lang'])){ 
              
        $_SESSION["lang"]= $_POST['lang'];
        header("Location: fotos_app_trad.php");
     
    
    } else if (isset($_POST['b_login'])){ //botón de LOGIN

        if(validar_user($_POST["email"], $_POST["pwd"])){

            $_SESSION["username"]= $_POST["username"];
            $_SESSION["dir"]= get_dir($_POST["email"]);   
        } 
        
        //header("Location: fotos_app_trad.php");       
              
    } else if (isset($_POST['b_layout'])){ //botón de LAYOUT

        $_SESSION["layout"]= $_POST["layout"];

    } else if (isset($_POST['b_prompt_login'])){ //botón de LOGIN
        
        form_login();
    
    } else if (isset($_POST['b_prompt_exit'])){ //botón de LOGIN
        
        header("Location: end_session_fotos.php");
                
    }//if..else

} //if $_POST
 
 ver(); //componente de las fotos, 

//PRUEBA get_dir("c.portillo.2324@yo.tu.es");

?>

</body>
</html>
