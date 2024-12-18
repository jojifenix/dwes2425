<h1>Listado de libros</h1>
<table border='1'>

<?php
echo "<h1>Biblioteca</h1>";

echo "<form action='" . $_SERVER['PHP_SELF'] . "'>
    <input type='hidden' name='action' value='libroGet'>
    <input type='text' name='textoBusqueda'>
    <input type='submit' value='Buscar'>
    </form><br><br>";

$actual = null; // Inicializamos con un valor que no coincida con ningún idLibro
$autores = ""; // Inicializamos una cadena vacía

if (!empty($data['libro_all'])) {
    $actual = $data['libro_all'][0];
    $campos = array_keys(get_object_vars($actual));
    unset($campos['nombre']);
    unset($campos['apellido']);

    foreach ($data['libro_all'] as $libro) {
        if ($libro->idLibro != $actual->idLibro) {
            echo "<tr>";
            foreach ($campos as $c) {
                echo "<td>" . $actual->$c . "</td>";
            }
            echo "<td>" . $autores . "</td>"; // autores acumulados

            if (isset($_SESSION['iduser'])) {
                echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroPrestart&idLibro=" . $actual->idLibro . "'>Prestar</a></td>";
            }

            if (isset($_SESSION['adm'])) {
                echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $actual->idLibro . "'>Modificar</a></td>
                      <td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $actual->idLibro . "'>Borrar</a></td>";
            }
            echo "</tr>";

            $actual = $libro;
            $autores = "";
        }
        $autores .= $libro->apellido . ", " . $libro->nombre . "<br>";
    }

    // Imprimir el último libro
    echo "<tr>";
    foreach ($campos as $c) {
        echo "<td>" . $actual->$c . "</td>";
    }
    echo "<td>" . $autores . "</td>"; // autores acumulados

    if (isset($_SESSION['iduser'])) {
        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroPrestart&idLibro=" . $actual->idLibro . "'>Prestar</a></td>";
    }

    if (isset($_SESSION['adm'])) {
        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $actual->idLibro . "'>Modificar</a></td>
              <td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $actual->idLibro . "'>Borrar</a></td>";
    }
    echo "</tr>";
}
?>

</table>
<p><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?action=libroForm">Nuevo</a></p>