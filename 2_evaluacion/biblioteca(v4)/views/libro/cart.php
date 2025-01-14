<!--Listado de libros-->
<table border='1'>
    <?php
   
    $libros = $data['libro_all'];//sólo los códigos no los datos completos
    print_r($libros); echo "<br/>";
    //TITULOS TABLA
    $campos = get_object_vars($libros[array_key_first($libros)]);
    echo "<tr>";
    foreach ($campos as $c => $v) {
        echo "<th>".strToUpper($c)."</th>\n";
    }
    echo "</tr>";
    // CUERPO TABLA.   Recorremos la lista de libros
    foreach ($libros as $libro) {
        echo "<tr>";
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