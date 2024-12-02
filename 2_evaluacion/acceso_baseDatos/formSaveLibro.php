<!-- formSaveLibro.php

    Clase del modelo
    Genera un FORM para insertar un libro
-->
<h1>Modificación de Libros</h1>
    <form action = '<?php echo $_SERVER['PHP_SELF']; ?> ' method = 'get'>
            Título:<input type='text' name='titulo'><br>
            Género:<input type='text' name='genero'><br>
            País:<input type='text' name='pais'><br>
            Año:<input type='text' name='ano'><br>
            Número de páginas:<input type='text' name='numPaginas'><br>";
            Autores: <select name='autor[]' multiple='true'>;
<?php

    foreach($autores as $fila){
        echo "<option value='" . $fila->idPersona . "'>" . $fila->nombre . " " . $fila->apellido . "</option>";
    }
?>
        </select>";
        <a href='index.php?action=formularioInsertarAutores'>Añadir nuevo</a><br>";
        <input type='hidden' name='action' value='insertarLibro'>
        <input type='submit'>
    </form>";
    echo "<p><a href='index.php'>Volver</a></p>";

