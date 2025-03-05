<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login con imgs</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <?php
    // Reutilizando el ejercicio de visualización de imágenes,
    // generar una aplicación que haga lo siguiente:
    // 1. Al iniciarse mostrará:
    //  a) un formulario de login y debajo
    //  b) un elemento select 'fila' que permita elegir un numero del 2 al 5
    //  c) una tabla con las imágenes que haya en un directorio public, 
    //    que tenga en cada fila el número de imágenes que se hayan selecionado en 
    //    'fila'.
    //  d) Una vez que se haya seleccionado una opcion de visualizacion, debera
    //    mantenerse la opcion elegida aunque se vaya a otras paginas de la app
    // 2. Validará los usuarios contra un archivo (se puede reutilizar el ejercicio
    //    de login anterior). Al validar a un usuario:
    //  a) Si no tiene una carpeta propia, se creará. La carpeta tendrá el mismo nombre
    //    que el mail del usuario, sustituyendo los caracteres no permitidos (@) por "_"
    //  b) El form de login se sustituira por un form para subir nuevas fotos a la carpeta
    //    del usuario. Solo se admitiran png, gif y jpg. Si se sube una nueva foto,
    //    mantendrá el nombre de origen, añadiendo fecha y hora. Y un enlace de desconexion
    //    que tenga una imagen de tipo boton. Al desconectar, se reiniciará la app eliminando
    //    cualquier preferencia o elemento del usuario.
    //  c) Se mantendrá el form para cambiar la visualizacion
    //  d) Se mostrarán las imágenes que haya en la carpeta del usuario, en el mismo
    //    formato de tabla de la pantalla anterior u otro si se cambia

    include("funciones.php");

    session_start();

    if ($_POST) {
        if (isset($_POST["btn_cols"]) && !isset($_SESSION["nombreUsuario"])) {
            $_SESSION["cols"] = $_POST["cols"];
            echo '<div class="formlogin">';
            formLogin();
            echo '</div>';
            echo '<div class="formColsImgs">';
            formNumCols();
            tablaImgs($_SESSION["cols"]);
            echo '</div>';
        } else if (isset($_POST["btn_login"])) {
            if (validarUsuario($_POST["user"], $_POST["pwd"])) {
                mensajeExito();
            } else {
                mensajeError();
            }
        } else if (isset($_POST["btn_cols"]) && isset($_SESSION["nombreUsuario"])) {
            $_SESSION["cols"] = $_POST["cols"];
            mensajeExito();
        } else {
            if (isset($_POST["btn_anadir"])) {
                if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
                    $midir = "img/" . str_replace("@", "_", $_SESSION["correo"]);
                    //$nombre = $_FILES['foto']['name'];
                    $ee = explode('.', $_FILES['foto']['name']);
                    $aaa = $ee[count($ee) - 2];
                    $nombre = $aaa;
                    $d = date("d-m-Y-h-i-s");
                    $nombre = $nombre . $d;

                    //extraer la extension. Se extrae de name, no de tmp_name
                    //$ee = explode('.', $_FILES['foto']['name']);
                    $ext = $ee[count($ee) - 1];

                    copy($_FILES['foto']['tmp_name'], $midir . '/' . $nombre . '.' . $ext);

                    //Por si hay que subirlo tb a public
                    //copy($_FILES['foto']['tmp_name'], "img/public/" . $nombre . '.' . $ext);
                    
                } else { //se pulsa el boton sin seleccionar archivo
                    echo "Possible file upload attack. Filename: " . $_FILES['foto']['name'] . "---" . $_FILES['foto']['tmp_name'];
                }
                mensajeExito();
            }
        }
    } else {
        if (!isset($_SESSION["nombreUsuario"])) {
            $_SESSION["cols"] = "2";
            echo '<div class="formlogin">';
            formLogin();
            echo '</div>';
            echo '<div class="formColsImgs">';
            formNumCols();
            tablaImgs($_SESSION["cols"]);
            echo '</div>';
        } else {
            mensajeExito();
        }
    }




    //La profe ha usado:

    //header("Location: ejercicio1.php");

    //en todo el flujo. De esta forma, va recargando la página con lógica distinta. 
    //Y va guardando todo en session. El flujo es más sencillo y claro.
    //Habria que reestructurar funciones como logOut. La profe tiene:

    //cabecera();
    //pulsadores de boton y actualizaciones de la pagina con header.
    //vista();

    //Tiene todos los elementos desde el principio (cabecera con welcome
    //que se actualiza al cargar el usuario, mensaje de salir que limpia toda
    //la sesión (está presente tanto sin loggear como loggeando)), y se van actualizando



    /*

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

    */




    ?>

</body>

</html>