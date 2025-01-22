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

    printf(MSSGS['maxbooks'],MAXBOOKS,MAXCART); echo "<br/>";
    $libros = $data['libro_cart']; 
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
        }//foreach campos
        //vista carrito asegura usuarios identificados
            echo "<td>";
            if (isset($_SESSION['cart'][$libro->idLibro]) && $_SESSION['cart'][$libro->idLibro] == 1) {//if prestado
                    echo MSSGS['borrowed'];

                    echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=libroDevolver&idLibro=".$libro->idLibro."'>".MSSGS['return']."</a>";
                    
                    echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=libroRenovar&idLibro=".$libro->idLibro."'>".MSSGS['extend']."</a>";
                } else {
                    echo MSSGS['reserved'];
                    echo "<td>";

                    echo "<td>";
                    if($data['prestados']=MAXBOOKS){
                        echo MSSGS['maxbooktd'];
                    }else{//admito el prestamos
                        echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=libroPrestar&idLibro=".$libro->idLibro."'>".MSSGS['borrow']."</a>";
                    }

                    echo "</td>";
                    echo "<td>";

                    echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=libroCancelar&idLibro=".$libro->idLibro."'>".MSSGS['cancel']."</a>";
                }
            echo "</td>";
    

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