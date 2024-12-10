<!-- Bd.php
     CLASE MODELO
     Gestiona la CONEXIÓN a la Bd

     Sigue un patrón SINGLETON:
     no debemos dejar que haya un número ilimitado de conexiones a la BD.
     Para solucinar ésto, SINGLETON hace innaccesible el constructor y ofrece en su lugar un método GetConn
     que DEVUELVE una sola conexión
-->

<?php
    //Creamos una clase $db para independizar la creación de la base de datos del libro. 
    class Bd {
        private $db = null;// Almacena la conexión con la base de datos(no se puedea acceder desde fuera de la clase)
        private function __construct() {} //al ser privado nadie podrá crear un new de él

        public function getConnD() {
            $this->db = new mysqli("localhost:3306", "root", "root", "books");
            if($this->db->connect_errno) return - 1;
            else return 0;
        }


        public function getConn($server,$username,$pass,$dbname) {
            $db = new mysqli($server,$username,$pass,$dbname);
            if($this->db->connect_errno) return - 1;
            else return 0;
        }

        public function closeConn(){
            if($this->db) $this->db->close();
        }
    }

