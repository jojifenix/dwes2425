<!-- fichv1.php -->

<?php
define("BR", "<br/>\n");

//puede venir de un $_POST, $_FILES...
$path= "data";
$nomf= $path."/alumnos.txt";

$f= fopen($nomf, "r");
$fout= fopen($path."/salida.txt", "w");

//si el fichero para LECTURA no existe, devuelve FALSE

if(!$f) echo "No existe el archivo $nomf";
else{
	
	//leer el archivo línea a línea
	while(!feof($f)){//comprobar si no es EOF
		
		$s= fgets($f);//MANTIENE el salto de linea al final de $s
		echo $s."<br/>"; //tenemos que poner el salot de linea nosotros
		fwrite($fout, $s."\n");		
		
	}
	
}
?>





