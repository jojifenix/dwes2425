<?php
include("view/cambiotrad.vista.inc.php");
session_start(); 
session_unset();  
session_destroy();  
header("Location: form_CambioDeMonedasTrad.php"); 
?>
