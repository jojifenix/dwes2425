<!-- libro/save.php

-->

<h1>Modificación de Libros</h1>
    <form action = '<?php $_SERVER['PHP_SELF'] ?>' method = 'get'>
            Título:<input type='text' name='titulo'><br>
            Género:<input type='text' name='genero'><br>
            País:<input type='text' name='pais'><br>
            Año:<input type='text' name='ano'><br>
            Número de páginas:<input type='text' name='numPaginas'><br>";


<!-- $result=$this->db->query("SELECT * FROM personas"); -->
    Autores: <select name='autor[]' multiple='true'>;
            
<?php

    foreach($data['persona_all'] as $fila){
        echo "<option value='" 
        .$fila->idPersona. "'>" 
        . $fila->nombre
        . " " .$fila->apellido. "</option>";
    }
?>
    </select>

    <a href='<?php echo $_SERVER['PHP_SELF'];?>?action=personaSave'>Añadir nuevo</a><br>";
    <input type='hidden' name='action' value='LibroSave'>
	<input type='submit'>

</form>";

<p><a href='<?php echo $_SERVER['PHP_SELF'];?>'>Volver</a></p>";

        






        </select>";
        <a href='index.php?action=formularioInsertarAutores'>Añadir nuevo</a><br>";
        <input type='hidden' name='action' value='insertarLibro'>
        <input type='submit'>
    </form>";
    echo "<p><a href='index.php'>Volver</a></p>";

