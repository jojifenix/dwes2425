<?php
//habilitar las excepciones en mysqli para usar try catch
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once "db.php";

class Libro{
    private $db;
    function __construct(){
        $this->db = new DB();
    }
    public function getPrestamos($iduser){
        // $q = "SELECT libros.idLibro, libros.titulo, libros.genero, libros.numPaginas, libros.ano, libros.pais, personas.nombre, personas.apellido, libros.ejemplares
        //         $q = "
        // SELECT 
        //     libros.idLibro AS idLibro, 
        //     libros.titulo, 
        //     libros.genero, 
        //     libros.numPaginas,
        //     libros.ano AS año,
        //     libros.disponibles,
        //     libros.pais AS pais,
        //     GROUP_CONCAT(CONCAT(personas.apellido, ', ', personas.nombre) SEPARATOR '; ') AS autores
        // FROM prestan
        // INNER JOIN libros ON prestan.idLibro = libros.idLibro
        // INNER JOIN escriben ON libros.idLibro = escriben.idLibro
        // INNER JOIN personas ON escriben.idPersona = personas.idPersona
        // WHERE prestan.iduser = ?
        // GROUP BY libros.idLibro
        // ORDER BY libros.idLibro, libros.titulo";

        // $q = "SELECT 
        // prestan.idLibro as idLibro,
        // titulo, genero, numPaginas,
        // ano as año,
        // disponibles,
        // libros.pais as pais,
        // from prestan
        // where iduser=?
        // inner join libros on prestan.idLibro = libros.idLibro
        // inner join escriben on libros.idLibro = escriben.idLibro
        // inner join personas on escriben.idPersona = personas.idPersona
        // group by libros.idLibro
        // order by libros.idLibro, libros.titulo";

        try {
            $db = new mysqli("localhost", "root", "root", "books");

            $q = "SELECT 
        prestan.idLibro as idLibro
        from prestan
        where iduser=?
        order by prestan.idLibro";

            if ($result = $db->execute_query($q, [$iduser])) { //id$user debe ser un array de un solo elemento por eso usamos el corchete (investigar que se usa asi para evitar inyeccion sql)
                if ($result->num_rows != 0) {
                    $items = [];
                    while ($fila = $result->fetch_object()) {
                        $items[] = $fila->idLibro;
                    }
                }
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error al buscar el libro: " . $e->getMessage();
            return [];  // En caso de error, se retorna un array vacío
        } finally {
            $db->close();  // Siempre se cierra la conexión
        }
        return $items;
        //se podria crear una vista en la base de datos con la consulta y llamar a la vista
        //$q = "SELECT * FROM vista_libros";
    }
     public function getAll(){
        // $q = "SELECT libros.idLibro, libros.titulo, libros.genero, libros.numPaginas, libros.ano, libros.pais, personas.nombre, personas.apellido, libros.ejemplares
        // $q = "SELECT libros.idLibro, libros.titulo, libros.genero, libros.numPaginas, libros.ano, libros.pais, libros.ejemplares, libros.disponibles, concat(personas.apellido, ', ', personas.nombre) as autores
        //     FROM libros 
        //     LEFT JOIN escriben ON libros.idLibro = escriben.idLibro 
        //     LEFT JOIN personas ON escriben.idPersona = personas.idPersona 
        //     ORDER BY libros.idLibro";

        $q = "SELECT * from vlibros";

        $items = $this->db->myQuery($q);
        return $items;

        //se podria crear una vista en la base de datos con la consulta y llamar a la vista
        //$q = "SELECT * FROM vista_libros";
    } 
    public function reservar($idLibro){
        try {
               $db = new mysqli("localhost", "root", "root", "books");
               if (mysqli_connect_errno()) {
                   printf("Connect failed: %s\n", mysqli_connect_error());
                   exit();
               }
        }catch (mysqli_sql_exception $e) {
               echo "Error al prestar el libro: " . $e->getMessage();
        }finally {
               $db->close();
        }
    }
    public function liberar($cart){
        try {
                $db = new mysqli("localhost", "root", "root", "books");
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }
                    //añadido dia 14012025
                $q = "UPDATE libros SET 
                      disponibles = disponibles - 1
                      WHERE idLibro IN(";
                $ids=[];
                foreach($cart as $id=>$v){
                    if($v==RESERVADO){
                        $ids[]=$id;
                        $q.="?,";
                    }
                }
                $q=rtrim($q,",").")";
                if(!empty($ids)){
                    $stmt=$db->prepare($q);
                    $stmt->bind_param(str_repeat('i',count($ids)),...$ids);
                    $stmt->execute();
                }
        } catch (mysqli_sql_exception $e) {
            echo "Error al liberar el libro: " . $e->getMessage();
        } finally {
            $db->close();
        }

    }
    public function prestar($iduser, $idLibro){
        // $q = "UPDATE libros SET disponibles = disponibles - 1 WHERE idLibro = " . $idLibro;
        // $resultado = $this->db->myUpdateQuery($q);


        // ----forma de la profe (sin crear la funcion myUpdateQuery en bd.php----

        try {
            $db = new mysqli("localhost", "root", "root", "books");

            if (mysqli_connect_errno()) {
                printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
            }

            $q = "UPDATE libros SET disponibles = disponibles - 1 WHERE idLibro =?";
            $db->execute_query($q, [$idLibro]);

            $q = "INSERT INTO prestan (iduser, idlibro) VALUES (?, ?)";
            $db->execute_query($q, [$iduser, $idLibro]);


            // $this->commit();

        } catch (mysqli_sql_exception $e) {
            echo "Error al prestar el libro: " . $e->getMessage();
        } finally {
            $db->close();
        }
    }
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
            $stmt = $db->prepare("INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES (?,?,?,?,?)");


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
    }
    //añadido 15012025
    public function getCart($ids){
        try {
            $db = new mysqli("localhost", "root", "root", "books");
            if(mysqli_connect_errno()){
                printf("Conexión fallida: %s\n", mysqli_connect_error());
                exit();
            }
            $items = [];
            if(!empty($ids)){

                $q = "SELECT idLibro,titulo,genero,numPaginas,ano,pais,autores 
                
                     FROM vlibros WHERE idLibro IN(";
                foreach ($ids as $id) {
                    $q .= "?, ";
                }
                if(!empty($ids))$q = rtrim($q, ", ") . ")";
            // print_r($ids); 
            // echo "<br/>";
                $result = $db->execute_query($q,array_keys($ids));//los valores están con las claves
                    if ($result->num_rows != 0) {
                        while ($fila = $result->fetch_object()) {
                            $items[] = $fila;
                        }
                    }
            }//if $ids
            return $items;
        } catch (mysqli_sql_exception $e) {
            echo "Error : " . $e->getMessage();
            return [];  // En caso de error, se retorna un array vacío
        } finally {
            $db->close();  // Siempre se cierra la conexión
        }
    }//getCart


    public function filter($busqueda){
        try {
            $db = new mysqli("localhost", "root", "root", "books");

            $textoBusqueda = $busqueda;
            echo "<h1>Resultados de la búsqueda: \"$textoBusqueda\"</h1>";

            // Buscamos los libros de la biblioteca que coincidan con el texto de búsqueda. 
            // Me ha tocado actualizar la consulta para que también busque por autor (o algo así)
            // if ($result = $db->execute_query("
            // SELECT 
            //     libros.idLibro AS idLibro, 
            //     libros.titulo, 
            //     libros.genero, 
            //     libros.numPaginas,
            //     libros.ano AS año,
            //     libros.disponibles,
            //     libros.pais AS pais,
            //     GROUP_CONCAT(CONCAT(personas.apellido, ', ', personas.nombre) SEPARATOR '; ') AS autores
            // FROM libros
            // LEFT JOIN escriben ON libros.idLibro = escriben.idLibro
            // LEFT JOIN personas ON escriben.idPersona = personas.idPersona
            // WHERE libros.titulo LIKE ?
            // OR libros.genero LIKE ?
            // OR personas.nombre LIKE ?
            // OR personas.apellido LIKE ?
            // OR libros.pais LIKE ?
            // OR libros.ano LIKE ?
            // OR libros.numPaginas LIKE ?
            // GROUP BY libros.idLibro
            // ORDER BY libros.titulo", [$textoBusqueda, $textoBusqueda, $textoBusqueda, $textoBusqueda, $textoBusqueda, $textoBusqueda, $textoBusqueda])) {

            //la profe lo hace con la vista envez de con la consulta entera, select * from vlibros where titulo like ? or genero like ? or autores like ? or pais like ? or ano like ? or numPaginas like ?

            $libro = [];
            if ($result = $db->execute_query("
            SELECT 
                *
            FROM vlibros
            where titulo like ?
            or genero like ?
            OR autores LIKE CONCAT('%', ?, '%')
            or pais like ?
            or ano like ?
            or numPaginas like ?
            ORDER BY vlibros.titulo", [$textoBusqueda, $textoBusqueda, $textoBusqueda, $textoBusqueda, $textoBusqueda, $textoBusqueda])) {
                if ($result->num_rows != 0) {


                    $libro = [];

                    while ($fila = $result->fetch_object()) {
                        $libro[] = $fila;
                    }
                }
            }
        } catch (mysqli_sql_exception $e) {
            echo "Error al buscar el libro: " . $e->getMessage();
            return [];  // En caso de error, se retorna un array vacío
        } finally {
            $db->close();  // Siempre se cierra la conexión
        }
        return $libro;  // Esta línea asegura que se devuelvan los libros encontrados
    }
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
    }
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
    }
}
