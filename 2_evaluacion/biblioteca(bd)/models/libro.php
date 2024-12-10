
<?php
/*
extraer todo lo de vista. Vamos a hacer un modelo por cada entidad y una vista por cada caso de uso
¿y cada vista en una clase diferente?
*/

//habilitar las excepciones en mysqli para usar try catch
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

class Libro
{

    // REVISAR SI METER PAIS TMBN

    // private $idLibro;
    // private $titulo;
    // private $genero;
    // private $numPaginas;
    // private $nombre;

    // --------------------------------- MOSTRAR LISTA DE LIBROS ----------------------------------------
    public static function getAll()
    {
        try {
            $db = new mysqli("localhost", "root", "root", "books");

            $result = $db->query("SELECT 
                                    titulo,genero,numPaginas,ano,
                                    libros.pais as pais,
                                    escriben.idLibro as idLibro,
                                    escriben.idPersona as idPersona,
                                    apellido,nombre
                                    LEFT JOIN escriben ON libros.idLibro = escriben.idLibro
                                    LEFT JOIN personas ON escriben.idPersona = personas.idPersona
                                    ORDER BY libros.idLibro, libros.titulo");
            //los libros que no tienen entrada en escriben no aparecen

            if ($result->num_rows != 0) {



                $libro = [];

                while ($fila = $result->fetch_object()) {
                    $libro[] = $fila;
                }
            }
            // $db->close();
            return $libro;
        } catch (mysqli_sql_exception $e) {
            echo "Error al buscar el libro: " . $e->getMessage();
        } finally {
            $result->close();//liberar memoria
            $db->close();
        }
    }



    // --------------------------------- FORMULARIO ALTA DE LIBROS ----------------------------------------

    public static function save($libro)
    {

        $autores = $libro['autor']; //es un array pq son varios
        unset($libro['autor']);

        try {
            $db = new mysqli("localhost", "root", "root", "books");
            // $db->autocommit(false);

            $db->commit();

            // $query = "INSERT INTO libros (titulo,genero,pais,ano,numPaginas) 
            // VALUES ('$titulo','$genero', '$pais', '$ano', '$numPaginas')";

            /*
            $query = "INSERT INTO libros (titulo,genero,pais,ano,numPaginas) 
            VALUES ("'
            .$libro['titulo']."','"
            .$libro['genero']."','"
            .$libro['pais']."','"
            .$libro['ano']."','"
            .$libro['numPaginas']."')";
            */

            //La profe ha cambiado los tipos de ano y numPaginas a varchar para poder insertar todo con comillas. 
            //Yo he probado y puedo insertar en int datos de String con comillas:
            //INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('libro4','genero4','pais4','año4','4444')
            // ^ funciona

            $query = "INSERT INTO libros (";
            foreach ($libro as $k => $v) {
                $query .= $k . ",";
            }
            $query = substr($query, 0, -1);
            $query .= ") VALUES (";
            foreach ($libro as $k => $v) {
                $query .= "'" . $v . "',";
            }
            $query = substr($query, 0, -1);
            $query .= ")";

            $db->query($query);

            if ($db->affected_rows == 1) {
                // Si la inserción del libro ha funcionado, continuamos insertando en la tabla "escriben"
                // Tenemos que averiguar qué idLibro se ha asignado al libro que acabamos de insertar
                $result = $db->query("SELECT LAST_INSERT_ID() AS idLibro");
                $idLibro = $result->fetch_object()->idLibro;
                // Ya podemos insertar todos los autores junto con el libro en "escriben"
                foreach ($autores as $idAutor) {
                    $q = "INSERT INTO escriben(idLibro, idPersona) VALUES('$idLibro', '$idAutor')";
                    echo "<br>";
                    echo $q;
                    echo "<br>";
                    $db->query($q);

                    if ($db->affected_rows != 1) $db->rollback();
                }
            }

            $db->commit();

            echo "<br>";
            echo $query;
            echo "<br>";
        } catch (mysqli_sql_exception $e) {
            echo "Error al insertar el libro: " . $e->getMessage();
        } finally {
            $db->close();
        }
    }

    public static function get($busqueda)
    {
        try {


            $db = new mysqli("localhost", "root", "root", "books");

            $textoBusqueda = $busqueda;
            echo "<h1>Resultados de la búsqueda: \"$textoBusqueda\"</h1>";

            // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda
            if ($result = $db->query("SELECT * FROM libros
					INNER JOIN escriben ON libros.idLibro = escriben.idLibro
					INNER JOIN personas ON escriben.idPersona = personas.idPersona
					WHERE libros.titulo LIKE '%$textoBusqueda%'
					OR libros.genero LIKE '%$textoBusqueda%'
					OR personas.nombre LIKE '%$textoBusqueda%'
					OR personas.apellido LIKE '%$textoBusqueda%'
					ORDER BY libros.titulo")) {

                if ($result->num_rows == 0) {
                    echo "No se encontraron datos";
                    return [];
                } else {

                    $libro = [];

                    while ($fila = $result->fetch_object()) {
                        $libro[] = $fila;
                    }
                }
            }
            // $db->close();
            return $libro;
        } catch (mysqli_sql_exception $e) {
            echo "Error al buscar el libro: " . $e->getMessage();
        } finally {
            $db->close();
        }
    }

    public static function delete($idLibro)
    {
        try {
            $db = new mysqli("localhost", "root", "root", "books");
            $db->query("DELETE FROM libros WHERE idLibro = '$idLibro'");
        } catch (mysqli_sql_exception $e) {
            echo "Error al borrar el libro: " . $e->getMessage();
        } finally {
            $db->close();
        }
    }

    public static function update($libro)
    {
        

        try {
            $db = new mysqli("localhost", "root", "root", "books");
            
            //verificar la conexion

            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            } //es redundante, se ha dejado de ejemplo

            $db->autocommit(false); //mysqli_autocommit($db, FALSE);
            $db->commit();
            

            // Obtener el ID del libro.
            //La profe lo consigue con un hidden en el formulario de save.php (?)
            $idLibro = $libro['idLibro'];

            // Extraer los autores del array (si existen)
            $autores = $libro['autor'];
            unset($libro['autor']);

            // Construir la consulta de actualización para la tabla `libros`
            $query = "UPDATE libros SET ";
            foreach ($libro as $campo => $valor) {
                $query .= "$campo = '$valor',";
            }
            $query = rtrim($query, ','); // Eliminar la última coma
            $query .= " WHERE idLibro = '$idLibro'";

            // Ejecutar la consulta de actualización
            //$db->autocommit(false); // Iniciar transacción
            if (!$db->query($query)) {
                $db->rollback();
                die("Error al actualizar el libro: " . $db->error);
            }

            echo "<br>";
            print_r($query);
            echo "<br>";

            // Actualizar los autores en la tabla `escriben`
            // Primero, eliminar las relaciones existentes
            $deleteQuery = "DELETE FROM escriben WHERE idLibro = '$idLibro'";
            if (!$db->query($deleteQuery)) {
                $db->rollback();
                die("Error al eliminar autores antiguos: " . $db->error);
            }

            echo "<br>";
            echo $deleteQuery;
            echo "<br>";

            // Insertar las nuevas relaciones autor-libro
            foreach ($autores as $idAutor) {
                $insertQuery = "INSERT INTO escriben (idLibro, idPersona) VALUES ('$idLibro', '$idAutor')";
                if (!$db->query($insertQuery)) {
                    $db->rollback(); //deshacer transacción
                    die("Error al insertar los nuevos autores: " . $db->error);
                }
                echo "<br>";
                print_r($insertQuery);
                echo "<br>";
            }

            $db->commit(); // Confirmar transacción si todo va bien
            // $db->close();
            echo "<br>";
            echo "Libro actualizado correctamente.";
            echo "<br>";
        } catch (mysqli_sql_exception $e) {
            echo "Error al actualizar el libro: " . $e->getMessage();
        } finally {
            $db->close();
        }
    }


    /*
    // --------------------------------- INSERTAR LIBROS ----------------------------------------

    public function insertarLibro() {
        echo "<h1>Alta de libros</h1>";

        // Vamos a procesar el formulario de alta de libros
        // Primero, recuperamos todos los datos del formulario
        $titulo = $_REQUEST["titulo"];
        $genero = $_REQUEST["genero"];
        $pais = $_REQUEST["pais"];
        $ano = $_REQUEST["ano"];
        $numPaginas = $_REQUEST["numPaginas"];
        $autores = $_REQUEST["autor"];

        // Lanzamos el INSERT contra la BD.
        echo "INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('$titulo','$genero', '$pais', '$ano', '$numPaginas')";
        $this->db->query("INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('$titulo','$genero', '$pais', '$ano', '$numPaginas')");
        if ($this->db->affected_rows == 1) {
            // Si la inserción del libro ha funcionado, continuamos insertando en la tabla "escriben"
            // Tenemos que averiguar qué idLibro se ha asignado al libro que acabamos de insertar
            $result = $this->db->query("SELECT MAX(idLibro) AS ultimoIdLibro FROM libros");
            $idLibro = $result->fetch_object()->ultimoIdLibro;
            // Ya podemos insertar todos los autores junto con el libro en "escriben"
            foreach ($autores as $idAutor) {
                $this->db->query("INSERT INTO escriben(idLibro, idPersona) VALUES('$idLibro', '$idAutor')");
            }
            echo "Libro insertado con éxito";
        } else {
            // Si la inserción del libro ha fallado, mostramos mensaje de error
            echo "Ha ocurrido un error al insertar el libro. Por favor, inténtelo más tarde.";
        }
        echo "<p><a href='".$_SERVER['PHP_SELF']."'>Volver</a></p>";

    }

    // --------------------------------- BORRAR LIBROS ----------------------------------------

    public function borrarLibro() {
        echo "<h1>Borrar libros</h1>";

        // Recuperamos el id del libro y lanzamos el DELETE contra la BD
        $idLibro = $_REQUEST["idLibro"];
        $this->db->query("DELETE FROM libros WHERE idLibro = '$idLibro'");

        // Mostramos mensaje con el resultado de la operación
        if ($this->db->affected_rows == 0) {
            echo "Ha ocurrido un error al borrar el libro. Por favor, inténtelo de nuevo";
        } else {
            echo "Libro borrado con éxito";
        }
        echo "<p><a href='".$_SERVER['PHP_SELF']."'>Volver</a></p>";

    }

    // --------------------------------- FORMULARIO MODIFICAR LIBROS ----------------------------------------

    public function formularioModificarLibro() {
        echo "<h1>Modificación de libros</h1>";

        // Recuperamos el id del libro que vamos a modificar y sacamos el resto de sus datos de la BD
        $idLibro = $_REQUEST["idLibro"];
        $result = $this->db->query("SELECT * FROM libros WHERE libros.idLibro = '$idLibro'");
        $libro = $result->fetch_object();

        // Creamos el formulario con los campos del libro
        // y lo rellenamos con los datos que hemos recuperado de la BD
        echo "<form action = '".$_SERVER['PHP_SELF']."' method = 'get'>
                <input type='hidden' name='idLibro' value='$idLibro'>
                Título:<input type='text' name='titulo' value='$libro->titulo'><br>
                Género:<input type='text' name='genero' value='$libro->genero'><br>
                País:<input type='text' name='pais' value='$libro->pais'><br>
                Año:<input type='text' name='ano' value='$libro->ano'><br>
                Número de páginas:<input type='text' name='numPaginas' value='$libro->numPaginas'><br>";

        // Vamos a añadir un selector para el id del autor o autores.
        // Para que salgan preseleccionados los autores del libro que estamos modificando, vamos a buscar
        // también a esos autores.
        $todosLosAutores = $this->db->query("SELECT * FROM personas");  // Obtener todos los autores
        $autoresLibro = $this->db->query("SELECT idPersona FROM escriben WHERE idLibro = '$idLibro'");             // Obtener solo los autores del libro que estamos buscando
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
        echo "</select>";

        // Por último, un enlace para crear un nuevo autor
        echo "<a href='".$_SERVER['PHP_SELF']."?action=formularioInsertarAutores'>Añadir nuevo</a><br>";

        // Finalizamos el formulario
        echo "  <input type='hidden' name='action' value='modificarLibro'>
                <input type='submit'>
              </form>";
        echo "<p><a href='".$_SERVER['PHP_SELF']."'>Volver</a></p>";

    }

    // --------------------------------- MODIFICAR LIBROS ----------------------------------------

    public function modificarLibro() {
        echo "<h1>Modificación de libros</h1>";

        // Vamos a procesar el formulario de modificación de libros
        // Primero, recuperamos todos los datos del formulario
        $idLibro = $_REQUEST["idLibro"];
        $titulo = $_REQUEST["titulo"];
        $genero = $_REQUEST["genero"];
        $pais = $_REQUEST["pais"];
        $ano = $_REQUEST["ano"];
        $numPaginas = $_REQUEST["numPaginas"];
        $autores = $_REQUEST["autor"];

        // Lanzamos el UPDATE contra la base de datos.
        $this->db->query("UPDATE libros SET
                        titulo = '$titulo',
                        genero = '$genero',
                        pais = '$pais',
                        ano = '$ano',
                        numPaginas = '$numPaginas'
                        WHERE idLibro = '$idLibro'");

        if ($this->db->affected_rows == 1) {
            // Si la modificación del libro ha funcionado, continuamos actualizando la tabla "escriben".
            // Primero borraremos todos los registros del libro actual y luego los insertaremos de nuevo
            $this->db->query("DELETE FROM escriben WHERE idLibro = '$idLibro'");
            // Ya podemos insertar todos los autores junto con el libro en "escriben"
            foreach ($autores as $idAutor) {
                $this->db->query("INSERT INTO escriben(idLibro, idPersona) VALUES('$idLibro', '$idAutor')");
            }
            echo "Libro actualizado con éxito";
        } else {
            // Si la modificación del libro ha fallado, mostramos mensaje de error
            echo "Ha ocurrido un error al modificar el libro. Por favor, inténtelo más tarde.";
        }
        echo "<p><a href='".$_SERVER['PHP_SELF']."'>Volver</a></p>";
    }

    // --------------------------------- BUSCAR LIBROS ----------------------------------------

    public function buscarLibros() {
        // Recuperamos el texto de búsqueda de la variable de formulario
        $textoBusqueda = $_REQUEST["textoBusqueda"];
        echo "<h1>Resultados de la búsqueda: \"$textoBusqueda\"</h1>";

        // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda
        if ($result = $this->db->query("SELECT * FROM libros
                INNER JOIN escriben ON libros.idLibro = escriben.idLibro
                INNER JOIN personas ON escriben.idPersona = personas.idPersona
                WHERE libros.titulo LIKE '%$textoBusqueda%'
                OR libros.genero LIKE '%$textoBusqueda%'
                OR personas.nombre LIKE '%$textoBusqueda%'
                OR personas.apellido LIKE '%$textoBusqueda%'
                ORDER BY libros.titulo")) {

            // La consulta se ha ejecutado con éxito. Vamos a ver si contiene registros
            if ($result->num_rows != 0) {
                // La consulta ha devuelto registros: vamos a mostrarlos
                // Primero, el formulario de búsqueda
                echo "<form action='".$_SERVER['PHP_SELF']."'>
                            <input type='hidden' name='action' value='buscarLibros'>
                            <input type='text' name='textoBusqueda'>
                            <input type='submit' value='Buscar'>
                      </form><br>";
                // Después, la tabla con los datos
                echo "<table border ='1'>";
                while ($fila = $result->fetch_object()) {
                    echo "<tr>";
                    echo "<td>" . $fila->titulo . "</td>";
                    echo "<td>" . $fila->genero . "</td>";
                    echo "<td>" . $fila->numPaginas . "</td>";
                    echo "<td>" . $fila->nombre . "</td>";
                    echo "<td>" . $fila->apellido . "</td>";
                    echo "<td><a href='".$_SERVER['PHP_SELF']."?action=formularioModificarLibro&idLibro=" . $fila->idLibro . "'>Modificar</a></td>";
                    echo "<td><a href='".$_SERVER['PHP_SELF']."?action=borrarLibro&idLibro=" . $fila->idLibro . "'>Borrar</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                // La consulta no contiene registros
                echo "No se encontraron datos";
            }
        } else {
            // La consulta ha fallado
            echo "Error al tratar de recuperar los datos de la base de datos. Por favor, inténtelo más tarde";
        }
        echo "<p><a href='".$_SERVER['PHP_SELF']."?action=formularioInsertarLibros'>Nuevo</a></p>";
        echo "<p><a href='".$_SERVER['PHP_SELF']."'>Volver</a></p>";
    }
*/
} // class
?>