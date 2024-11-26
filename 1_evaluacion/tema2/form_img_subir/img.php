<!DOCTYPE html>
<html lang="en">                                                 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir_imágenes</title>
</head>
    <h1>Subir_imágenes</h1>
<body>
    
<?php
//formatos válidos
DEFINE("IMGS",array("jpg","jpeg","gif","png"));
DEFINE("BR","<br>");

function validar($nomf){

    //formación del patron con las extensiones válidas          
    $patt="/";
    foreach(IMGS as $v) $patt.="$v|";
    $patt=substr($patt,0,-1)."/";

    //obtener la extensión del archivo
    $ee=explode(".",$nomf);//me da array de un string con todas las partes separadas por puntos
    $ext=$ee[count($ee)-1];                 //sizeof($ee)


    //$ext=pathinfo($nomf,PATHINFO_EXTENSION);

    echo $patt.BR;
    return preg_match($patt,$ext);//validar la extensión contra el patrón
}

/*function crea_thumb($foto,$dir){}*/

function form_add(){
    $f="<form action='img.php' method='post' enctype='multipart/form-data'>".BR;
    $f.=$_SERVER['PHP_SELF']."method='post'".BR;
    $f.="Añadir nueva foto: <input type='file' name='foto'>".BR;
    $f.="<input type='submit' name='ok_add' value='enviar'>".BR;
    $f.="</form>".BR;
    echo $f;
}

//VARIABLES QUE PUEDEN VENIR DE UN $_POST


$midir='img';
$numcols=4;
//pintar el form
form_add();
//control de flujo
if(isset($_POST['ok_add'])){
    if(is_uploaded_file($_FILES['foto']['tmp_name'])){
        print_r($_FILES);
    
        //extraer la extensión del nombre de origen
        $ee=explode(".",$_FILES['foto']['name']);
        $ext=$ee[count($ee)-1];
        $nombre="Nueva";  //hay que poner nombres que no sobre-escriban.
        //añadir fecha y hora al nombre para que no se sobre-escriban
        $nombre.=date("d-m-y-H-i-s");
        
        copy($_FILES['foto']['tmp_name'],$midir."/$nombre.".$ext);
        
    }else{
        echo"Possible file upload attack. Filename: ".$_FILES['foto']['name']."---".$_FILES['foto']['tmp_name'];}
}//add

if($gestor=opendir($midir)){//abrir un directorio
    echo"<table border=1>";
    $i=0;
    while(false!==($archivo=readdir($gestor))){
        //if ($archivo!="." && $archivo!=".."&&validar($archivo))
        if(validar($archivo)){
            //solo se visualizan las imágenes de los formatos permitidos
           
            if($i%$numcols==0) echo"<tr>"; //inicio fila
            echo"<td>";
            //echo"<a href='$midir/thumb/'MINI-archivo'> 
            echo"<a href='$midir/$archivo'><img src='$midir/$archivo' width='100' height='100'></a>";
            echo"</td>";
            if($i%$numcols==($numcols-1))
                echo"</tr>";//termino fila
            $i++;
        }//if validar
    }//while

echo"</table>";
closedir($gestor);

}

?>
</body>
</html>

