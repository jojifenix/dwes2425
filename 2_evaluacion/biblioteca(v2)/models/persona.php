
<?php
/*
extraer todo lo de vista. Vamos a hacer un modelo por cada entidad y una vista por cada caso de uso
¿y cada vista en una clase diferente?
*/
require_once("dao.php");
class Persona{
    private $db;


    function __construct(){
        $this->db= new Db();
    }
    // private $idLibro;
    // private $titulo;
    // private $genero;
    // private $numPaginas;
    // private $nombre;

    // --------------------------------- MOSTRAR LISTA DE AUTORES ----------------------------------------
    public function getAll(){
        $q= "SELECT * FROM personas ORDER BY apellido";
        $libro=$this->db->myQuery($q);
        return $libro;

    }//getall



    // --------------------------------- FORMULARIO ALTA DE LIBROS ----------------------------------------

    public function formularioInsertarLibros() {}

    // --------------------------------- FORMULARIO ALTA DE AUTORES ----------------------------------------

    public function save($p) {
        $db = new mysqli("localhost", "root", "root", "books");

        $q = "INSERT INTO personas (nombre, apellido, pais) VALUES ('$p[nombre]', '$p[apellido]', '$p[pais]')";
        echo $q;
        $result = $db->query($q);

        // if ($result->num_rows != 0) $data['result'] = "Persona insertada con éxito";
        // else $data['result'] = "Ha ocurrido un error al insertar la persona. Por favor, inténtelo más tarde.";

        $db->close();

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