<!--
alluser.php
-->
<h1>Listado de libros</h1>
<table border='1'>

<?php
echo "<h1>Biblioteca</h1>";
echo "<form action='" . $_SERVER['PHP_SELF'] . "'>
    <input type='hidden' name='action' value='libroGet'>
    <input type='text' name='textoBusqueda'>
    <input type='submit' value='Buscar'>
    </form><br><br>";

$actual = -1; 
$autores = ""; 

foreach ($data['libro_all'] as $libro) {
    if ($libro->idLibro != $actual) {
        if ($actual != -1) {
            echo "<tr>
                <td>" . $actual . "</td>
                <td>" . $titulo . "</td>
                <td>" . $genero . "</td>
                <td>" . $pais . "</td>
                <td>" . $numPaginas . "</td>
                <td>" . $autores . "</td>";
            if(isset($rol)&&($rol=="admin")){
                echo"<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $actual . "'>Modificar</a></td>
                     <td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $actual . "'>Borrar</a></td>
                     </tr>";
            }//if isset rol tambien ponerlo en el parrafo despues de table
        }
        $actual = $libro->idLibro;
        $titulo = $libro->titulo;
        $genero = $libro->genero;
        $numPaginas = $libro->numPaginas;
        $autores = ""; 
    }
    $autores .= $libro->apellido . ", " . $libro->nombre . "<br>";
}

if ($actual != -1) {
    echo "<tr>
        <td>" . $actual . "</td>
        <td>" . $titulo . "</td>
        <td>" . $genero . "</td>
        <td>" . $numPaginas . "</td>
        <td>" . $autores . "</td>
        <td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $actual . "'>Modificar</a></td>
        <td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $actual . "'>Borrar</a></td>
    </tr>";
}
    ?>
</table>
<p><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?action=libroForm">Nuevo</a></p>