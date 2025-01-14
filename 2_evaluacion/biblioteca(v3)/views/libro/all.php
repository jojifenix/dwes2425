<h1>Listado de libros</h1>
<h1>Biblioteca</h1>";

<form action=" . $_SERVER['PHP_SELF'] .">
    <input type='hidden' name='action' value='libroGet'>
    <input type='text' name='textoBusqueda'>
    <input type='submit' value='Buscar'>
    </form><br><br>";

<table border='1'>

<?php

if(!empty($data['libro_all'])){
    $actual = $data['libro_all'][0];
    //la query me da el nombre y apellido juntos formateados en un campo autor
    $campos = array_keys(get_object_vars($actual));// de objeto a array
    //unset($campos['nombre']);//debido a la concatenacion del archivo libro.php

    //CABECERAS
    echo "<tr>";
    foreach ($campos as $k=>$v){
        echo "<th>".strToUpper($k)."</th>";
    }
    echo "</tr>";

    foreach ($data['libro_all'] as $libro) {
        echo "<tr>";

        if ($libro->idLibro != $actual->idLibro) {
            foreach ($campos as $c) {
                echo "<td>" . $actual->$c . "</td>";
            }
            //echo "<td>" . $autores . "</td>"; // autores acumulados

            if (isset($_SESSION['iduser'])) {
                echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroPrestart&idLibro=" . $actual->idLibro . "'>Prestar</a></td>";
            }

            if (isset($_SESSION['adm'])) {
                echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $actual->idLibro . "'>Modificar</a></td>
                      <td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $actual->idLibro . "'>Borrar</a></td>";
            }
            echo "</tr>";

            $actual = $libro;
          // $actual->autores="";
           // $actual->autores = "";
        }//if idLIbro
        //$autores .= $libro->apellido . ", " . $libro->nombre . "<br>";
        //$autores .= $libro->autores."<br>"; //por la concatenacion en libro.php
        $actual->autores.=$libro->autores."<br>";

        

    }//foreach

    // Imprimir el último libro
    echo "<tr>";
    foreach ($campos as $c) {
        echo "<td>" . $actual->$c . "</td>";
    }
    //echo "<td>" . $autores . "</td>"; // autores acumulados

    if (isset($_SESSION['iduser'])) {
        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroPrestart&idLibro=" . $actual->idLibro . "'>Prestar</a></td>";
    }

    if (isset($_SESSION['adm'])) {
        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $actual->idLibro . "'>Modificar</a></td>
              <td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $actual->idLibro . "'>Borrar</a></td>";
    }
    echo "</tr>";
}else{
    echo "<tr><td colspan='5'>No hay libros disponibles </td></tr>";
}

?>

</table>
<p><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?action=libroForm">Nuevo</a></p>