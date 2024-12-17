<!--dao.php
Clase modelo
Contiene métodos genéricos para acceder a la BD-->
<?php
    //habilitar las excepciones en mysqli para usar try catch
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    class Db{
        private $db; //guardar conexion con la BD

        function __construct(){
            require_once("config.inc.php");
            $this->db=new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            if($this->db->connect_errno) return -1;
            else return 0;
        }//construct


        function close(){
            if($this->db) $this->db->close();
        }


        function myQuery($q){
            try{
                $result= $this->db->execute_query($q);//consulta preparada
                if ($result->num_rows != 0) {
                    $libro = [];
                    while ($fila = $result->fetch_object()) {
                        $libro[] = $fila;
                    }
                }//if
                    return $libro;
            } catch (mysqli_sql_exception $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                $result->close();//liberar memoria
            }
            return $libro;
        }//lanza una consulta $q de tipo SELECT, recibe una consulta $q y devuelve un array bidimensional con los resultados de la consulta.Si no hay datos , devuelve un array vacío.







    }
?>
















































/*

    
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
           
        }
    }



    

    public static function save($libro)
    {

        $autores = $libro['autor']; //es un array pq son varios
        unset($libro['autor']);

        try {
            $db = new mysqli("localhost", "root", "root", "books");
   

            $db->commit();

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
               
                $result = $db->query("SELECT LAST_INSERT_ID() AS idLibro");
                $idLibro = $result->fetch_object()->idLibro;
           
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

*/
 


