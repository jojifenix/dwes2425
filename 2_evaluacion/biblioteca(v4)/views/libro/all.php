<h1>Listado de libros</h1>
<table border='1'>
    <?php
    // Mostrar formulario de búsqueda
    echo "<h1>Biblioteca</h1>";
    echo "<form action='" . $_SERVER['PHP_SELF'] . "'>
        <input type='hidden' name='action' value='libroGet'>
        <input type='text' name='textoBusqueda'> 
        <input type='submit' value='Buscar'>
    </form>";

    $libros = $data['libro_all']; // Primer libro

    $campos = (get_object_vars($libros[0])); // Obtener nombres de propiedades 

    echo "<tr>";
    foreach ($campos as $c => $v) {
        echo "<th>$c</th>";
    }
    echo "</tr>";

    // Recorremos la lista de libros
    foreach ($libros as $libro) {
        echo "<tr>";

        //salto de linea entre autores
        $libro->autores = str_replace(";", "<br>", ucwords($libro->autores));

        foreach ($campos as $c => $v) {
            echo "<td>" . ($libro->$c) . "</td>";
        }


        // if (isset($_SESSION['adm'])) {
        //     if ($libro->disponibles > 0) {
        //         echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroReservar&idLibro=" . $libro->idLibro . "'>".MSSGS['reserve']."</a></td>";
        //     } else {
        //         echo "<td>".MSSGS['unavailable']."</td>";
        //     }
        //     echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $libro->idLibro . "'>Modificar</a></td>";
        //     echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $libro->idLibro . "'>Borrar</a></td>";
        // } elseif (isset($_SESSION['iduser'])) {
        //     if ($libro->disponibles > 0) {
        //         echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroReservar&idLibro=" . $libro->idLibro . "'>".MSSGS['reserve']."</a></td>";
        //     } else {
        //         echo "<td>".MSSGS['unavailable']."</td>";
        //     }
        // }

        if (isset($_SESSION['iduser'])) {
            echo "<td>";

            if (isset($_SESSION['cart'][$libro->idLibro])) {
                if ($_SESSION['cart'][$libro->idLibro] === 0) {
                    echo MSSGS['reserved'];
                } else if ($_SESSION['cart'][$libro->idLibro] === 1) {
                    echo MSSGS['borrowed'];
                }
            } else if ($libro->disponibles > 0) {
                echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=libroReservar&idLibro=" . $libro->idLibro . "'>" . MSSGS['reserve'] . "</a>";
            } else {
                echo MSSGS['unavailable'];
            }
            echo "</td>";
        }

        if (isset($_SESSION['adm'])) {
            echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $libro->idLibro . "'>Modificar</a></td>";
            echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $libro->idLibro . "'>Borrar</a></td>";
        }

        echo "</tr>";
    } 



    ?>
</table>

<?php
// Botón para añadir nuevo libro (si es admin)
if (isset($_SESSION['adm'])) {
    echo "<p><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm'>Nuevo</a></p>";
}
?>