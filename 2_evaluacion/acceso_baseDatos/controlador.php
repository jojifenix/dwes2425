
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>

<body>
    <?php

    /*
    Para el control de la app usamos 3 variables 

    $action: siguiente método a ejecutar
    $view: siguiente vista a renderizar
    $data: array que contiene los datos para generar las vistas
    
    */

    include('models/libro.php'); 
    include('models/persona.php');
    include('view.php');

    // Miramos el valor de la variable "action", si existe. Si no, le asignamos una acción por defecto
    if (isset($_REQUEST["action"])) {
        $action = $_REQUEST["action"];
    } else {
        $action = "libroAll";  
    }

    $biblio = new Biblioteca();
    $biblio->$action();

    class Biblioteca{
        private $db=null;

        public function __construct(){
            $this->db = new mysqli();
        }

        public function libroAll(){
            $data['libro_all']=Libro::getAll();
            View::render('libro/all',$data);
        }

        public function libroForm(){
            $data['persona_all']=Persona::getAll();
            View::render('libro/save',$data);
        }

        public function libroSave(){
            $libro=$_REQUEST;
            $autores=$_REQUEST['autor'];//array PQ son varios autores
            unset($libro['action']);
            unset($libro['autor']);
           // print_r($_REQUEST);
           Libro::save($libro);
           //mostrar la lista de libros
           $this->libroAll();

        } 
    }
    ?>
</body>
</html>
