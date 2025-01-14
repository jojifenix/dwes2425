<?php

//habilitar las excepciones en mysqli para usar try catch
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

require_once "db.php";

class Libro{
    private $db;

    function __construct(){
        $this->db = new DB();
    }//construct

    public function getAll(){
            $q = "SELECT escriben.idLibro as idLibro,
                        titulo,genero,numPaginas,ano as año, disponibles ,
                        libros.pais as pais,
                        concat(apellido, ',', nombre) as autores
                        
            FROM libros 
            LEFT JOIN escriben ON libros.idLibro = escriben.idLibro 
            LEFT JOIN personas ON escriben.idPersona = personas.idPersona 
            ORDER BY libros.idLibro, libros.titulo";  

            //$p=SELECT * FROM vlibros; Otra opción sería crear una VISTA en mysql de la parte de arriba asi solo la llamamos.
            $items = $this->db->myQuery($q);
            return $items;
    }//getAll

    public function getPrestamos($iduser){

        try {


            $db = new mysqli("localhost", "root", "root", "books");
            $q = "SELECT 
                        prestan.idLibro as idLibro,
                        titulo,genero,numPaginas,
                        ano as año,
                        disponibles,
                        libros.pais as pais,
                        concat(apellido, ',', nombre) as autores
                        FROM prestan
                        INNER JOIN escriben ON prestan.idLibro = escriben.idLibro 
                        INNER JOIN personas ON escriben.idPersona = personas.idPersona 
                        WHERE iduser=?
                        ORDER BY libros.idLibro, libros.titulo";
                    
            $items = $this->db->myQuery($q);
            return $items;
        } catch (mysqli_sql_exception $e) {
            echo "Error al prestar el libro " . $e->getMessage();
        } finally {
            $db->close();
        }
    }  //getPrestamos
    public function save($libro){
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


            //Consulta preparada: plantilla sql
            $stmt = $db->prepare("INSERT INTO libros (titulo,genero,pais,ano,numPaginas,ejemplares) VALUES (?,?,?,?,?)");


            $titulo = $libro['titulo'];
            $genero = $libro['genero'];
            $pais = $libro['pais'];
            $ano = $libro['ano'];
            $numPaginas = $libro['numPaginas'];

            //prepared statement: binding
            $stmt->bind_param('sssss', $titulo, $genero, $pais, $ano, $numPaginas);

            $stmt->execute();


            //otra forma:
            // $q = "INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('$titulo','$genero', '$pais', '$ano', '$numPaginas')";
            // $valores = array_values($libro);
            // $db->execute_query($q, $valores);



            // $query = "INSERT INTO libros (";
            // foreach ($libro as $k => $v) {
            //     $query .= $k . ",";
            // }
            // $query = substr($query, 0, -1);
            // $query .= ") VALUES (";
            // foreach ($libro as $k => $v) {
            //     $query .= "'" . $v . "',";
            // }
            // $query = substr($query, 0, -1);
            // $query .= ")";

            // $db->query($query);    
            //->>>> la profe no tiene asi la consulta. La tiene como arriba.

            if ($db->affected_rows == 1) {
                // Si la inserción del libro ha funcionado, continuamos insertando en la tabla "escriben"
                // Tenemos que averiguar qué idLibro se ha asignado al libro que acabamos de insertar
                $result = $db->query("SELECT LAST_INSERT_ID() AS idLibro");
                $idLibro = $result->fetch_object()->idLibro;
                // Ya podemos insertar todos los autores junto con el libro en "escriben"
                foreach ($autores as $idAutor) {
                    $q = "INSERT INTO escriben(idLibro, idPersona) VALUES('$idLibro', '$idAutor')";

                    //con consulta preparada
                    // $q = "INSERT INTO escriben(idLibro, idPersona) VALUES(?, ?)";
                    // $params = array_values([$idLibro, $idAutor]);
                    // $db->execute_query($q, $params);

                    echo "<br>";
                    echo $q;
                    echo "<br>";
                    $db->query($q);

                    if ($db->affected_rows != 1) $db->rollback();
                }
            }

            $db->commit();

            echo "<br>";
            // echo $stmt;
            echo "<br>";
        } catch (mysqli_sql_exception $e) {
            echo "Error al insertar el libro: " . $e->getMessage();
        } finally {
            $db->close();
        }
    }//save

    public function get($busqueda){
        try {


            $db = new mysqli("localhost", "root", "root", "books");

            $textoBusqueda = $busqueda;
            echo "<h1>Resultados de la búsqueda: \"$textoBusqueda\"</h1>";

            // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda
            // if ($result = $db->query("SELECT * FROM libros
            // 		INNER JOIN escriben ON libros.idLibro = escriben.idLibro
            // 		INNER JOIN personas ON escriben.idPersona = personas.idPersona
            // 		WHERE libros.titulo LIKE '%$textoBusqueda%'
            // 		OR libros.genero LIKE '%$textoBusqueda%'
            // 		OR personas.nombre LIKE '%$textoBusqueda%'
            // 		OR personas.apellido LIKE '%$textoBusqueda%'
            // 		ORDER BY libros.titulo")) {

            if ($result = $db->execute_query("SELECT * FROM libros
                                    LEFT JOIN escriben ON libros.idLibro = escriben.idLibro
                                    LEFT JOIN personas ON escriben.idPersona = personas.idPersona
                                    WHERE libros.titulo LIKE ?
                                    OR libros.genero LIKE ?
                                    OR personas.nombre LIKE ?
                                    OR personas.apellido LIKE ?
                                    ORDER BY libros.titulo", [$textoBusqueda, $textoBusqueda, $textoBusqueda, $textoBusqueda])) {

                //consulta preparada:
                // $q = "SELECT * FROM libros
                // INNER JOIN escriben ON libros.idLibro = escriben.idLibro
                // INNER JOIN personas ON escriben.idPersona = personas.idPersona
                // WHERE libros.titulo LIKE ?
                // OR libros.genero LIKE ?
                // OR personas.nombre LIKE ?
                // OR personas.apellido LIKE ?
                // ORDER BY libros.titulo";

                // $params = array_values([$textoBusqueda, $textoBusqueda, $textoBusqueda, $textoBusqueda]);
                // $result = $db->execute_query($q, $params);

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
    }//get
    
    public function delete($idLibro){
        try {
            $db = new mysqli("localhost", "root", "root", "books");
            $db->query("DELETE FROM libros WHERE idLibro = '$idLibro'");

            //consulta preparada:
            // $q = "DELETE FROM libros WHERE idLibro = ?";
            // $db->execute_query($q, [$idLibro]);

        } catch (mysqli_sql_exception $e) {
            echo "Error al borrar el libro: " . $e->getMessage();
        } finally {
            $db->close();
        }
    }//delete

    public function update($libro){


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
            // $query = "UPDATE libros SET ";
            // foreach ($libro as $campo => $valor) {
            //     $query .= "$campo = '$valor',";
            // }
            // $query = rtrim($query, ','); // Eliminar la última coma
            // $query .= " WHERE idLibro = '$idLibro'";

            //Consulta preparada: plantilla sql
            $q = ("UPDATE libros SET titulo = ?, genero = ?, pais = ?, ano = ?, numPaginas = ? WHERE idLibro = ?");


            $db->execute_query($q, [$libro['titulo'], $libro['genero'], $libro['pais'], $libro['ano'], $libro['numPaginas'], $idLibro]);



            // Ejecutar la consulta de actualización
            //$db->autocommit(false); // Iniciar transacción
            // if (!$db->query($query)) {
            //     $db->rollback();
            //     die("Error al actualizar el libro: " . $db->error);
            // }

            echo "<br>";
            // print_r($query);
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
    }//update

    public function prestar($iduser,$item){
            
            try {
                $db = new mysqli("localhost", "root", "root", "books");
                //verificar la conexion
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                } 
                //transaccion
                $db->autocommit(false);
                $db->commit();
                //consulta preparada
                $q= "UPDATE libros SET
                disponibles=disponibles-1
                WHERE  idLibro=?";

                $db->execute_query($q,[$item]);

                //anotar préstamo al usuario
                $q="INSERT INTO prestan (iduser,idLibro)
                    VALUES (?,?)";
                  $db->execute_query($iduser,$item);
              
            } catch (mysqli_sql_exception $e) {
                echo "Error al prestar el libro: " . $e->getMessage();
            } finally {
               $db->close();
            }
    }//prestar
}
