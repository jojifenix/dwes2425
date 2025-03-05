<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario cambio de monedas</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <?php
    include("data/cambiotrad.inc.php");
    include("view/cambiotrad.vista.inc.php");
    session_start(); //si la sesion no existe, la crea. Si existe, la reanuda
    print_r($_SESSION); echo BR;
    //formLang();
    //form();

    if ($_POST) { //Si vienen por get enseñamos el formulario
        if (isset($_POST["btn_lang"])) { //Traducimos
            $_SESSION["lang"] = $_POST["lang"]; //Memorizar la variable de sesión
            formLang($_SESSION["lang"]);
            form($_SESSION["lang"]);
        } else { //Cambiamos
            if (validar($_POST["cant"], $_SESSION["lang"])) {
                mensaje($_SESSION["lang"], $_POST["cant"], VALS[$_POST["moneda"]]);
            }
        }
    } else {
        /*Dos maneras de llegar: al principio (GET) o desde el <a> volver*/
        // formLang($_SESSION["lang"]); //al principio se imrpime en esp
        // form($_SESSION["lang"]);

        //forma de la profe

        //entrar por GET URL
        if (!isset($_SESSION["lang"])) {
            $_SESSION["lang"] = "es";
        }
        formLang($_SESSION["lang"]);
        form($_SESSION["lang"]);
    }


    ?>
</body>

</html>