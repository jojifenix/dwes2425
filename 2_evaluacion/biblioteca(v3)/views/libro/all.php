<!--
extraer todo lo de vista. Vamos a hacer un modelo por cada entidad y una vista por cada caso de uso
¿y cada vista en una clase diferente?
Aqui no hacemos el fetch, sino que recibimos el array ya hecho ($libros)
-->

<h1>Listado de libros</h1>
<table border='1'>

    <?php
   
    // Cada libro ha de aparecer una sola vez

    echo "<h1>Biblioteca</h1>";

    echo "<form action='" . $_SERVER['PHP_SELF'] . "'>
    <input type='hidden' name='action' value='libroGet'>
    <input type='text' name='textoBusqueda'> 
    <input type='submit' value='Buscar'>
    </form>";


    $actual =$data['libro_all'][0]; // Inicializamos con un valor que no coincida con ningún idLibro
    $autores = ""; // Inicializamos una cadena vacía
    $campos = array_keys(get_object_vars($actual));
    unset($campos['nombre']);
    unset($campos['apellido']);

    foreach ($data['libro_all'] as $libro) {
        if ($libro->idLibro != $actual->idLibro) {
            echo "<tr>";
            foreach($campos as $c) 
                echo "<td>".$actual->$c."</td>";
                echo"<td>".$autores."</td>";//autores acumulados

                if (isset($_SESSION['iduser'])) {
                    echo "</td><a href='".$_SERVER['PHP_SELF']."?action=libroPrestart&idLibro=".$actual."'>Prestar</a></td></tr>";
                }
        
                if (isset($_SESSION['adm'])) {
                    echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $actual . "'>Modificar</a></td>
                    <td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $actual . "'>Borrar</a></td>
                    </tr>";
                
                }
        }
    $actual = $libro->idLibro;
    $autores = ""; 
    }

    // Acumulamos los autores
    $autores .= $libro->apellido . ", " . $libro->nombre . "<br>";
    

    // Imprimir el último libro
        echo "<tr>";
        foreach($campos as $c) echo "<td>".$actual->$c."</td>";
        echo"<td>".$autores."</td>";//autores acumulados

        

        if (isset($_SESSION['iduser'])) {
            echo "</td><a href='".$_SERVER['PHP_SELF']."?action=libroPrestart&idLibro=".$actual."'>Prestar</a></td></tr>";
        }

        if (isset($_SESSION['adm'])) {
            echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm&idLibro=" . $actual . "'>Modificar</a></td>
            <td><a href='" . $_SERVER['PHP_SELF'] . "?action=libroDelete&idLibro=" . $actual . "'>Borrar</a></td>
            </tr>";
        
        }
    



    ?>


</table>
<?php
if (isset($rol) && $rol == "admin") {
    echo "<p><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm'>Nuevo</a></p>";
}
?>