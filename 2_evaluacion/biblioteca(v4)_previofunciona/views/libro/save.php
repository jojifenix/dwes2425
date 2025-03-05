<!--
genera un form pa insertar un libro
-->

<h1>Modificación de libros</h1>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="get">

    <?php

    if (isset($data['libroID'])) {

        $db = new mysqli("localhost", "root", "root", "books");

        $idLibro = $data['libroID'];
        $result = $db->query("SELECT * FROM libros WHERE libros.idLibro = '$idLibro'");
        $libro = $result->fetch_object();

        // Creamos el formulario con los campos del libro
        // y lo rellenamos con los datos que hemos recuperado de la BD
        echo "<form action = '" . $_SERVER['PHP_SELF'] . "' method = 'get'>
            <input type='hidden' name='idLibro' value='$idLibro'>
            Título:<input type='text' name='titulo' value='$libro->titulo'><br>
            Género:<input type='text' name='genero' value='$libro->genero'><br>
            País:<input type='text' name='pais' value='$libro->pais'><br>
            Año:<input type='text' name='ano' value='$libro->ano'><br>
            Número de páginas:<input type='text' name='numPaginas' value='$libro->numPaginas'><br>";

        $todosLosAutores = $db->query("SELECT * FROM personas");  // Obtener todos los autores
        $autoresLibro = $db->query("SELECT idPersona FROM escriben WHERE idLibro = '$idLibro'");             // Obtener solo los autores del libro que estamos buscando
        // Vamos a convertir esa lista de autores del libro en un array de ids de personas
        $listaAutoresLibro = array();
        while ($autor = $autoresLibro->fetch_object()) {
            $listaAutoresLibro[] = $autor->idPersona;
        }

        // Ya tenemos todos los datos para añadir el selector de autores al formulario
        echo "Autores: <select name='autor[]' multiple size='3'>";
        while ($fila = $todosLosAutores->fetch_object()) {
            if (in_array($fila->idPersona, $listaAutoresLibro))
                echo "<option value='$fila->idPersona' selected>$fila->nombre $fila->apellido</option>";
            else
                echo "<option value='$fila->idPersona'>$fila->nombre $fila->apellido</option>";
        }
        echo "</select>
         <a href='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?action=personaForm'>Añadir nuevo</a><br>


    <input type='hidden' name='action' value='libroModificar'>
    <input type='submit'>";
    } else {
        // Creamos el formulario con los campos del libro
        echo "<form action = '" . $_SERVER['PHP_SELF'] . "' method = 'get'>
            Título:<input type='text' name='titulo'><br>
            Género:<input type='text' name='genero'><br>
            País:<input type='text' name='pais'><br>
            Año:<input type='text' name='ano'><br>
            Número de páginas:<input type='text' name='numPaginas'><br>
            Autores: <select name='autor[]' multiple>";
        foreach ($data['persona_all'] as $fila) {
            echo "<option value='" . $fila->idPersona . "'>" . $fila->nombre . " " . $fila->apellido . "</option>";
        }
        echo "</select>
 <a href='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?action=personaForm'>Añadir nuevo</a><br>


    <input type='hidden' name='action' value='libroSave'>
    <input type='submit'>";
    }


    // $result = $this->db->query("SELECT * FROM personas");
    //

    //$autores=[]
    //while ($fila = $result->fetch_object()) {
    //$autores[]=$fila
    //}



    ?>


</form>
<p><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">Volver</a></p>