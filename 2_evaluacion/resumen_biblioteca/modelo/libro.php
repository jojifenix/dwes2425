<!DOCTYPE html>
<!--libro.php 
    Modelo -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // 1) HABILITAR CONTROL DE ERRORES
    mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);//función que establece el modo de informe de errores(se debe informar de todos los de mysqli y como excepciones).Así podemos capturarlas más tarde.

    // 2) CREAMOS LA CLASE "Libro" 
    class Libro{
        private $db;// la propiedad sólo es accesible desde dentro de la clase si un método o propiedad es public puede llamarse desde fuera de la clase.
        function __construct(){
            $this->db=new mysqli("localhost","root","root","books");     
        }

    }
    ?>
</body>
</html>