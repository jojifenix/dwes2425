<?php
require_once "data/cambiotrad.inc.php";

function formLang($lang="es"){
    $l = LANGS[$lang];

    echo '<form method="post" action="' . $_SERVER["PHP_SELF"]. '">

    <div class="div1">
        <p class="pform">' . $l["choose_lang"] . 
            '<select name="lang">';  

        foreach (LANGS as $k => $fila) {
            echo '<option value="' . $k . '">' . $fila["name"] . '</option>';
        }

    echo '    </select><br/> </p> 
        <input class ="enviar" type="submit" name="btn_lang" value="' . $l["btn_trad"] . '">
    </div>

    </form>';
}
function form($lang="es"){
    $l = LANGS[$lang];
    
    echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">

    <div class="div1">
        <p class="pform">' . $l["cantidad"] . '</p><br />
        <input class="cant" type="string" name="cant"> <br />
    </div>

    <div class="div2">
        <p class="pform">' . $l["convertira"] . '
            <select name="moneda">';
    foreach (VALS as $k => $fila) {
        echo '<option value="' . $k . '">' . $l[$k] . '</option>';
    }
    echo '    </select>
        </p><br/>
        <input class="enviar" type="submit" name="Cambiar" value="' . $l["cambiar"] . '">
    </div>

    </form>';
}
function error($lang="es"){
    $l = LANGS[$lang];
    echo "<p>" . $l["error"] . "</p>";
    volver($_SESSION["lang"]); //deja un enlace
}
function mensaje($lang="es", $cant, $mon){
    $l = LANGS[$lang];

    $cambio = $cant * $mon["tipo"];
    echo "<p class='pphp'>" . $cant . " " . $l["mensaje1"] . $cambio . " " . $mon["literal"] . "</p>";
    volver($_SESSION["lang"]);
}
function volver($lang="es"){
    $l = LANGS[$lang];
    echo "<p class='pphp'><a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>" . $l["volver"] . "</a></p>";
    echo "<p class='pphp'><a href='end_session.php'>" . $l["finalizar"] . "</a></p>";

}
function validar($cant, $lang="es"){
    $l = LANGS[$lang];
    if (!is_numeric($cant) || $cant < 0) {
        echo "<p class='pphp'>" . $l["error1"] . "</p>";
        volver($_SESSION["lang"]);
        return false;
    } elseif ($cant > MAX_CANT) {
        echo "<p class='pphp'>" . $l["error2"] . "</p>";
        volver($_SESSION["lang"]);
        return false;
    }

    return true;
}
