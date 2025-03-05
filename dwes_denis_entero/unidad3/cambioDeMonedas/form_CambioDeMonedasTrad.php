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
    session_start();

    $v = new Vista();
    if ($_POST) {
        if (isset($_POST["btn_lang"])) {
            $_SESSION["lang"] = $_POST['lang'];
            $v->setLang($_SESSION["lang"]);
            $v->formLang();
            $v->form();
        } else { 
            if ($v->validar($_POST["cant"])) {
                $v->mensaje($_POST["cant"], VALS[$_POST["moneda"]]);
            }
        }
    } else {
        if (!isset($_SESSION["lang"])) {
            $_SESSION["lang"] = "es";
        } 
        $v->formLang();
        $v->form();
    }
    ?>
    
</body>
</html>