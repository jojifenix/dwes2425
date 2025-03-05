<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <?php
    // Ejercicio: APP con las siguientes especificaciones:
    //     ·traducible
    //     ·aplicacion SAP (una sola pagina)
    //     ·Formulario de login
    //     ·Archivo users.txt con lineas en formato mail pwd nombre 
    //      Al entrar por pimera vez:
    //          ·un mensaje para introducir los datos
    //          ·formulario de login
    //      Si el usuario es validado: 
    //          ·mostrará una cabecera de bienvenida personalizado con el nombre del usuario
    //          ·desaparece el form de login
    //          ·un enlace <a> para salir y terminar la sesion

    include("funciones.php");
    include("traducciones.php");

    session_start();

    validar();


    if ($_POST) {
        if (isset($_POST["btn_lang"])) {
            $_SESSION["idioma"] = $_POST["lang"];
            formLang();
            formLogin();
        } else {
            if (validar($_POST["user"], $_POST["pwd"])) {
                mensajeExito();
            } else {
                mensajeError();
            }
        }
    } else {
        if (!isset($_SESSION["nombreUsuario"])) {
            $_SESSION["idioma"] = "es";
            formLang();
            formLogin();
        } else {
            mensajeExito();
        }
    }







    ?>
</body>

</html>