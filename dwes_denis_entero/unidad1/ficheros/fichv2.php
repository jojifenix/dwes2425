<!-- fichv1.php -->

<?php
define("BR", "<br/>\n");

//puede venir de un $_POST, $_FILES...
$path= "data";
$nomf= $path."/alumnos.txt";

$f= fopen($nomf, "r");
$fout= fopen($path."/salida2.txt", "w");

//si el fichero para LECTURA no existe, devuelve FALSE

if(!$f) echo "No existe el archivo $nomf";
else{
	
	//leer el archivo línea a línea
	while(!feof($f)){//comprobar si no es EOF
		
		$s= fgets($f); //igual que readline de bufferedreader de Java. Mantiene saltos linea
		echo $s;
		fwrite($fout, $s);		
		
	}
	
}
fclose($f);
fclose($fout);






