<?php

define("BR", "<br/>\n");
define("IMGS", array("jpg", "png", "gif"));
define("COLS", array(2, 3, 4, 5));

function formLogin()
{
    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
    
        <div class='divuserclave'>
        <input type='text' name='user' placeholder='Correo electrónico...'> <br />
        
        <input type='password' name='pwd' placeholder='Contraseña...'> <br /><br /></div>
        <div class ='diventrar'><input type='submit' name='btn_login' value='Entrar'>
    </div>
</form>";
}

function formNumCols()
{

    echo "<div class='num_cols'><form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
    
        <p>Numero de columnas
        <select name='cols'>";
    // <option value='2'>2</option>
    // <option value='3'>3</option>
    // <option value='4'>4</option>
    // <option value='5'>5</option>
    foreach (COLS as $v) {
        if ($v == $_SESSION["cols"]) {
            echo "<option value='$v' selected>$v</option>";
        } else {
            echo "<option value='$v'>$v</option>";
        }
    }
    echo "</select>
        <input type='submit' name='btn_cols' value='Cambiar'>
    </p>
</div>
</form>";
}

function formAnadir()
{
    //form pa añadir nuevas fotos
    //enctype para permitir datos que no sean simples

    $f = "<form enctype=multipart/form-data action=";
    $f .= $_SERVER['PHP_SELF'] . " method='post'>" . BR;
    $f .= "<input type=file name=foto>" . BR;
    $f .= "<input type='submit' name=btn_anadir value=Enviar>" . BR;
    $f .= "</form>" . BR;

    echo $f;
}

function validarFichero($nomf)
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

function tablaImgs($numcols, $midir = "img/public")
{
    if ($gestor = opendir($midir)) {
        echo "<div class='tabla_imgs'><table border=1>";
        $i = 0;

        while (false !== ($archivo = readdir($gestor))) { //leer archivo a archivo 
            // if ($archivo != '.' && $archivo != ".." && validar($archivo)) { //filtra . y ..
            if (validarFichero($archivo)) {
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

    echo "</table></div>";
    closedir($gestor);
}

function validarUsuario($user = "", $pwd = "")
{


    $nomf = "data/users.txt";
    $f = fopen($nomf, "r");


    //si el fichero para LECTURA no existe, devuelve FALSE

    if (!$f) return false; // el fichero no existe
    else {

        //leer el archivo línea a línea
        while (!feof($f)) { //comprobar si no es EOF

            $s = fgets($f);
            $h = explode(" ", trim($s));
            $correo = $h[0];
            $clave = $h[1];
            $name = $h[2];

            if ($user == $correo && $pwd === $clave) {
                $_SESSION["nombreUsuario"] = $name;
                $_SESSION["correo"] = $correo;
                return true;
            }
        }
        return false;
    }
    fclose($f);
}

function mensajeError()
{
    echo '<div class="formlogin">';
    formLogin();
    echo "<p class='error'>Usuario o contraseña incorrectos</p>";
    echo '</div>';
    echo '<div class="formColsImgs">';
    formNumCols();
    tablaImgs($_SESSION["cols"]);
    echo '</div>';
}

function mensajeExito()
{
    //comprobar si existe o no la carpeta:
    $carpeta = "img/" . str_replace("@", "_", $_SESSION["correo"]);
    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }
    echo '<div class="divlogout">';
    mensajeLogout();
    echo "<p class='correcto'>" . $_SESSION["nombreUsuario"] . ", has iniciado sesión correctamente</p>";
    formAnadir();
    echo '</div>';
    echo '<div class="formColsImgs2">';
    formNumCols();
    tablaImgs($_SESSION["cols"], $carpeta);
    echo '</div>';
}

function mensajeLogout()
{
    echo "<a class='exit' href='end_session.php'><img src='img/logout.png' style='width: 100px; height: 100px;'/>
</a>";
}
