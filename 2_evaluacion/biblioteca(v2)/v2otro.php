<!-- BIBLIOTECA VERSIÓN 1
     Características de esta versión:
       - Código monolítico (sin arquitectura MVC)
       - Sin seguridad
       - Sin sesiones ni control de acceso
       - Sin reutilización de código
-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <?php

    /*
    Para el control de la app usamos 3 variables:
    $action: siguiente método a ejecutar
    $view: siguiente vista a renderizar
    $data: datos que se pasan a la vista
    */

    include 'models/libro.php';
    include 'models/persona.php';
    include 'models/user.php';
    include 'view.php';

    // Miramos el valor de la variable "action", si existe. Si no, le asignamos una acción por defecto



    if (isset($_REQUEST["action"])) {
        $action = $_REQUEST["action"];
    } else {
        $action = "libroAll";  // Acción por defecto
    }

    print_r($_REQUEST);
    echo "<br>";
    print_r($action);
    echo "<br>";

    // Creamos un objeto de tipo Biblioteca y llamamos al método $action()
    $biblio = new Biblioteca();
    $biblio->$action();

    class Biblioteca
    {
        // private $db = null;     // Conexión con la base de datos

        // public function __construct()
        // {
        //     $this->db = new mysqli("localhost:3306", "root", "root", "books"); //si en host no ponemos puerto, por defecto es 3306
        // }

        //No hace falta conectarse aqui
        private $db=null;
        private $libro, $persona, $user;
        public function __construct(){

                $this->libro= new libro();
                $this->persona= new persona();
                $this->user= new user();

        }






        public function libroAll()
        {
            $data['libro_all'] = $this->libro->getAll();
            View::render('libro/all', $data);
        }

        // --------------------------------- FORMULARIO ALTA DE LIBROS ----------------------------------------

        public function libroForm()
        {
            if (isset($_REQUEST['idLibro'])) {
                $data['libroID'] = $_REQUEST['idLibro'];
            }
            $data['persona_all'] = $this->persona->getAll();
            View::render('libro/save', $data);
        }

        // --------------------------------- INSERTAR LIBROS ----------------------------------------

        public function libroSave()
        {

            $libro = $_REQUEST; //datos del formulario
            // $autores=$_REQUEST['autor'];
            unset($libro['action']);
            // unset($libro['autor']);
            print_r($libro);
            // Libro::save($libro, $autores);
            $this->libro->save($libro);
            // View::render('libro/all');
            $this->libroAll();
        }

        public function libroModificar()
        {
            $libro = $_REQUEST;
            unset($libro['action']);
            $this->libro->update($libro);
            $this->libroAll();
        }

        public function loginForm()
        {
            View::render('login'); // -> manda a userControl
        }

        public function userValidate(){
            //recoge los datos del form y comprobar si existe el usuario y con qué roles
            $data['login']=$_REQUEST;
            $iduser=$this->user->validate($data['login']);
            if($iduser){//validado iduser!=0
            //pedir los roles del usuario... devuelve un array
            $roles=$this->user->getRoles($iduser);
            //cargar en la sesión id, rol y preferencias si las hay
            session_start();
            $_SESSION['iduser']=$iduser;
            if(isset($roles['adm']))$_SESSION['adm']= $iduser;
            //mostrar vista principal correspondiente a ese rol
            //TO DO: desconectar, destruir sesión.
            print_r($_SESSION); echo"</br";
            //mostrar la vista personalizada para el adminstrador
            $this->libroAll();
            }else{
                $this->loginForm();
                echo "Datos incorrectos.Intente idenfiticarse otra vez";
               
            }
        
           
        }//userValidate

        public function logOut(){
            session_destroy();
           
        }
        public function personaForm()
        {
            View::render('persona/save'); // -> manda a personaSave
        }

        public function personaSave()
        {
            $persona = $_REQUEST;
            unset($persona['action']);
            $this->persona->save($persona);
            unset($persona['nombre']);
            unset($persona['apellido']);
            unset($persona['pais']);
            $this->libroForm();
        }


        public function libroGet()
        {
            $data['libro_all'] = Libro::get($_REQUEST['textoBusqueda']);
            View::render('libro/all', $data);
            echo "<p><a href='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>Resetear búsqueda</a></p>";
        }


        public function libroDelete()
        {
            $this->libro->delete($_REQUEST['idLibro']);
            $this->libroAll();
        }
        // --------------------------------- BORRAR LIBROS ----------------------------------------
        // public function borrarLibro()
        // {
        //     echo "<h1>Borrar libros</h1>";

        //     // Recuperamos el id del libro y lanzamos el DELETE contra la BD
        //     $idLibro = $_REQUEST["idLibro"];
        //     $this->db->query("DELETE FROM libros WHERE idLibro = '$idLibro'");

        //     // Mostramos mensaje con el resultado de la operación
        //     if ($this->db->affected_rows == 0) {
        //         echo "Ha ocurrido un error al borrar el libro. Por favor, inténtelo de nuevo";
        //     } else {
        //         echo "Libro borrado con éxito";
        //     }
        //     echo "<p><a href='" . $_SERVER['PHP_SELF'] . "'>Volver</a></p>";
        // }

        // --------------------------------- FORMULARIO MODIFICAR LIBROS ----------------------------------------

        public function formularioModificarLibro()
        {
            echo "<h1>Modificación de libros</h1>";

            // Recuperamos el id del libro que vamos a modificar y sacamos el resto de sus datos de la BD
            $idLibro = $_REQUEST["idLibro"];
            $result = $this->db->query("SELECT * FROM libros WHERE libros.idLibro = '$idLibro'");
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
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?action=formularioInsertarAutores'>Añadir nuevo</a><br>";

            // Finalizamos el formulario
            echo "  <input type='hidden' name='action' value='modificarLibro'>
                    <input type='submit'>
                  </form>";
            echo "<p><a href='" . $_SERVER['PHP_SELF'] . "'>Volver</a></p>";
        }

        // --------------------------------- MODIFICAR LIBROS ----------------------------------------

        public function modificarLibro()
        {
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
            echo "<p><a href='" . $_SERVER['PHP_SELF'] . "'>Volver</a></p>";
        }

        // --------------------------------- BUSCAR LIBROS ----------------------------------------

        public function buscarLibros()
        {
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
                    echo "<form action='" . $_SERVER['PHP_SELF'] . "'>
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
                        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=formularioModificarLibro&idLibro=" . $fila->idLibro . "'>Modificar</a></td>";
                        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=borrarLibro&idLibro=" . $fila->idLibro . "'>Borrar</a></td>";
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
            echo "<p><a href='" . $_SERVER['PHP_SELF'] . "?action=formularioInsertarLibros'>Nuevo</a></p>";
            echo "<p><a href='" . $_SERVER['PHP_SELF'] . "'>Volver</a></p>";
        }
    } // class
    ?>

</body>

</html>