<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario_clases</title>
</head>
<body>
    <h2>Cambio de monedas e idiomas con clases</h2>
<?php

include "data_monedatrad_vista/cambiotrad.vista.inc.php";
session_start();
print_r($_SESSION);
echo BR;
//Creamos la instancia de la clase Vista 
$v= new Vista(); //por defecto , "es"



if($_POST){
    if(isset($_POST['b_lang'])){
        $v->form_lang();
        $v->form();
        $_SESSION['lang']=$_POST['lang'];
        $v->setLang($_SESSION['lang']); //cuando ésto traduce a la primera el idioma de la vista no a la segunda
    }else{
          if($v->validar($_POST["cant"]))
          $v->mensaje($_POST["cant"],VALS[$_POST["moneda"]]);
        }
}else{
    if(!isset($_SESSION['lang']))
    $_SESSION['lang']='es'; 
    $v->form_lang();
    $v->form();
}

?>
</body>
</html>

