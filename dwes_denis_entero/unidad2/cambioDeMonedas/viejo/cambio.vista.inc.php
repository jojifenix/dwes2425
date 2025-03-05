<?php
require_once "data/cambio.inc.php";

function form()
{
    echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">

    <div class="div1">
        <p class="pform">Cantidad a convertir </p><br />
        <input class="cant" type="string" name="cant"> <br />
    </div>

    <div class="div2">
        <p class="pform">Convertir a:
            <select name="moneda">';
    foreach (VALS as $k => $fila) {
        echo '<option value="' . $k . '">' . $fila["literal"] . '</option>';
    }
    echo '    </select>
        </p><br/>
        <input class="enviar" type="submit" name="Cambiar" value="Cambiar">
    </div>

</form>';
}

function error()
{
    echo "<p>Acceso incorrecto</p>";
    volver(); //deja un enlace
}

function mensaje($cant, $mon)
{
    $cambio = $cant * $mon["tipo"];
    echo "<p class='pphp'>" . $cant . " euros equivalen a " . $cambio . " " . $mon["literal"] . "</p>";
    volver();
}

function volver()
{
    echo "<p class='pphp'><a href='form_CambioDeMonedas.php'>Volver</a></p>";
}

function validar($cant)
{
    if (!is_numeric($cant) || $cant < 0) {
        echo "<p class='pphp'>Error: la cantidad debe ser mayor que 0</p>";
        volver();
        return false;
    } elseif ($cant > MAX_CANT) {
        echo "<p class='pphp'>Error: la cantidad no puede ser mayor que " . MAX_CANT . "</p>";
        volver();
        return false;
    }

    return true;
}
