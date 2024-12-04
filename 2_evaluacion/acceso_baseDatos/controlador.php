
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

        public function __construct(){}

        public function personaForm(){
            View::render('persona/save'); //submit action = personaSave
        }
        public function personaSave(){
           $persona=$_REQUEST; 
           unset($persona['action']);
           Persona::save($persona);
           $this->libroForm();
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
            $libro=$_REQUEST; //como $_REQUEST es variable global funciona dentro del save o fuera, aunque seria mas correcto aquí en nuestro caso, el modelo no deberia saber nada de la petición mejor el controlador. En esta request se guardan datos introducidos en el formulario
            unset($libro['action']);
           Libro::save($libro);
           //mostrar la lista de libros
           $this->libroAll();

        } }
    
    ?>
</body>
</html>
