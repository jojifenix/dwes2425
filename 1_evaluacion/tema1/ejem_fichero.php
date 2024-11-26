<!-- fichv1.php -->

<?php
define("BR", "<br/>\n");

//puede venir de un $_POST, $_FILES...
$path= "data";
$nomf= $path."\\alumnos.txt";/*El problema principal con tu código es la forma en que estás especificando la ruta del archivo alumnos.txt. 
Estás utilizando barras invertidas (\) para separar las carpetas en la ruta, 
lo cual puede causar problemas de compatibilidad, especialmente entre diferentes sistemas 
operativos. En Windows, las barras invertidas se utilizan para las rutas, pero en la mayoría 
de los sistemas operativos y en PHP, se recomienda usar barras normales (/).*/

//ABRIR un archivo ...MODOS de apertura

$f= fopen($nomf, "r");
$fout= fopen($path."/salida.txt", "w"); //w borra todo y refresca nuevamente sobreescribiendo
	//si fuera "a" es apend, que no borra nada solo añade.


//si el fichero para LECTURA no existe, devuelve FALSE

if(!$f) echo "No existe el archivo $nomf";
else{
	
	//leer el archivo línea a línea
	while(!feof($f)){//comprobar si no es EOF (file end of file).Cuando se encuentre el final del fichero para
		
		$c= fgetc($f);//lee char a char 
		if ($c !== "\n" && $c !== "\r"){
				fwrite($fout, $c);
		
		echo $c;//el echo escribe en el codigo fuente de la página no en el navegador ni archivo de texto.
	}
	
		//	el salto de linea que tenemos en un bloque de texto el de salida.txt no es interpretado 
		//por el navegador ya que no son etiquetas html, pero si vemos el código del navegador vemos que si está
		//esructurado como salida.txt.
		//en conclusión el navegador nos muestra el texto interpretado .
		//porque la salida mantiene los saltos de línea ? porque el salto de linea es un char. (\n)
		
	}
	
}






