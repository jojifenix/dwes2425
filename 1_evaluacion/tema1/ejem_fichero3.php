<!--empleados.inc.php-->
<?php
include"empleados.inc.php";
foreach(HEADS as $h) echo $h.BR;
//las constantes también pueden ser arrays(antes constantes solían ser strings)

$path="data";
$nomf=$path."/empleadosv1.txt";

$f=fopen($nomf, "r");
fclose($f);

 
 
?>