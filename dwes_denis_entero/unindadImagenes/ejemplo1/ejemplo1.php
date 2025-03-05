<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de imagenes</title>
</head>

<body>
    <?php

    define("IMGS", array("jpg", "png", "bmp", "gif", "jgif"));
    define("BR", "<br>\n");

    function validar($nomf)
    {
        //formacion del patron con las extensiones validas
        $patt = "/";
        foreach (IMGS as $v) $patt .= "$v|";
        $patt = substr($patt, 0, -1) . "/";

        //obtener extension del archivo
        $ee = explode('.', $nomf);
        $ext = $ee[count($ee) - 1];   //sizeof($ee)

        //$ext = pathinfo($nomf, PATHINFO_EXTENSION);	

        return preg_match($patt, $ext); //validar la extension contra el patron
    }

    //no funciona, ignorar
    /*
    function crea_thumb($foto, $dir) {
        if(!is_dir($dir.'/thumb'))
            mkdir($dir.'/thumb', 0777);
    }
    */

    function form_add()
    {
        //form pa añadir nuevas fotos
        //enctype para permitir datos que no sean simples

        $f = "<form enctype=multipart/form-data action=";
        $f .= $_SERVER['PHP_SELF'] . " method='post'>" . BR;
        $f .= "Añadir nueva foto: <input type=file name=foto>" . BR;
        $f .= "<input type='submit' name=ok_add value=Enviar>" . BR;
        $f .= "</form>" . BR;

        echo $f;
    }

    //variables que pueden venir de un $_POST
    //nose ven dentro de las funciones
    $midir = 'img';
    $numcols = 4;

    form_add();

    if (isset($_POST['ok_add'])) {
        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
            print_r($_FILES);

            
            //$nombre = date(DATE_RFC822);
            //$nombre = "nueva"; //-> hay que poner nombres que no se sobreescriban
            //print($nombre);

            $nombre = "foto";
            $d = date("d-m-Y-h-i-s");
            $nombre = $nombre . $d;

            //extraer la extension. Se extrae de name, no de tmp_name
            $ee = explode('.', $_FILES['foto']['name']);
            $ext = $ee[count($ee) - 1];

            copy($_FILES['foto']['tmp_name'], $midir . '/' . $nombre . '.' . $ext);
        } else { //se pulsa el boton sin seleccionar archivo
            echo "Possible file upload attack. Filename: " . $_FILES['foto']['name'] . "---" . $_FILES['foto']['tmp_name'];
        }
        //add


        if ($gestor = opendir($midir)) {
            echo "<table border=1>";
            $i = 0;

            while (false !== ($archivo = readdir($gestor))) { //leer archivo a archivo 
                // if ($archivo != '.' && $archivo != ".." && validar($archivo)) { //filtra . y ..
                if (validar($archivo)) {
                    if (($i % $numcols) == 0) echo "<tr>"; //inicio fila

                    echo "<td>";
                    //echo "<a href=$midir/thumb/'MINI-$archivo'>
                    echo "<a href=$midir/$archivo>
            <img src=$midir/$archivo width=100 height=100></a>";
                    echo "</td>";

                    if (($i % $numcols) == $numcols - 1) echo "</tr>"; //fin fila

                    $i++;
                }
            }
        }

        echo "</table>";
        closedir($gestor);
    }


    //CARDINALIDADES

    //1 a 1 -> ?
    //1 a muchos -> +
    //0 a muchos -> *
    //Cualquier caracter -> .

    // ".+\.(gif|jpg|png)$" -> almenos un caracter, luego un punto y luego la extension


    ?>
</body>

</html>