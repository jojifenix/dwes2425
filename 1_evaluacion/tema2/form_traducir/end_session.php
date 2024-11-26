 
<?php

//end_session.php
session_start();//propagar la sesión para recuperar el PHPSESSID
echo"<br/>".session_id(); 
session_unset();//elimina $_SESSION del servidor pero no la cookie.//libera memoria del servidor
session_destroy(); 
header("Location: ejer_form_moneda_traducir_sesion.php");
?>

