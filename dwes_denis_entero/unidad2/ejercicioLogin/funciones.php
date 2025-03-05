<?php

define("BR", "<br/>\n");

function formLogin()
{
    $l = LANGS[$_SESSION["idioma"]];
    echo '<form class="login" method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">

    <div>
        <p>' . $l["email"] . '
        <input class="email" type="text" name="user"> <br /></p>
        <p>' . $l["contra"] . '
        <input class="pwd" type="password" name="pwd"> <br /></p><br />
        <div class ="diventrar"><input class="entrar" type="submit" name="btn_send" value="' . $l["accion"] . '">
    </div></div>

</form>';
}

function formLang()
{
    $l = LANGS[$_SESSION["idioma"]];

    echo '<form class="idioma" method="post" action="' . $_SERVER["PHP_SELF"] . '">

    <div>
        <div class ="diventrar"><p>' . $l["choose_lang"] .
        '<select name="lang">';

    foreach (LANGS as $k => $fila) {
        echo '<option value="' . $k . '">' . $fila["name"] . '</option>';
    }

    echo '    </select><br/> </p> </div>
    <div class ="diventrar">    <input class="entrar" type="submit" name="btn_lang" value="' . $l["btn_trad"] . '">
    </div></div>

</form>';
}


function validar($user = "", $pwd = "")
{
    $nomf = "users.txt";
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
                return true;
            }
        }
        return false;
    }
    fclose($f);
}

function mensajeExito()
{
    $l = LANGS[$_SESSION["idioma"]];

    echo "<a class='exit' href='end_session.php'>" . $l["salir"] . "</a>";
    echo "<p class='correcto'>" . $_SESSION["nombreUsuario"] . ", " . $l["exito"] . "</p>";
}

function mensajeError()
{
    $l = LANGS[$_SESSION["idioma"]];
    formLang();
    formLogin();
    echo "<p class='error'>" . $l["error"] . "</p>";
}
