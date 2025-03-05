<!-- fichv1.php -->

<?php
define("BR", "<br/>\n");

//puede venir de un $_POST, $_FILES...
$path= "data";
$nomf= $path."\\alumnos.txt"; //cuidado con el sentido de las barras
//    \\deberia ser mas general que /, pero en Windows no importa
//abrir un archivo... MODOS

$f= fopen($nomf, "r"); //para lectura
$fout= fopen($path."\\salida.txt", "w"); //para escritura desde 0. Si existe, se borra
//con "a" se añade al final del archivo (append)

//si el fichero para LECTURA no existe, devuelve FALSE

if(!$f) echo "No existe el archivo $nomf"; //si no existe, no da error. Imprime esto
else{
	//leer el archivo línea a línea
	while(!feof($f)){//comprobar si no es EOF  -> file end of file
		$c= fgetc($f); //lee caracter a caracter y devuelve un string
		if ($c !== "\n" && $c !== "\r") { //de esta forma quito los saltos de línea en salida.txt
			fwrite($fout, $c); //escribir en el archivo de salida
			//echo $c; //no muestra los saltos de linea ni en fuente ni en txt
		}
		echo $c; //muestra el salto de linea en el fuente de la pag pero no en el txt
		//if ($c != "\n" && $c != "\r") -> se ha intentao añadir pa omitir los char \n y \r
		//echo $c;	//en salida.txt se ve en distintas lineas, con el echo no. 
		//Los \n no se visualizan en el navegador y si en los txt. \n \r son char
		
	}
	
}
fclose($f);
fclose($fout);






