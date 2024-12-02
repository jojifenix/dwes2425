<!-- autores.php

-->

<?php
    class Autores {
       
        public static function getAll() { 
            $db = new mysqli("localhost:3306", "root", "root", "books");
            $result = $db->query("SELECT * FROM personas ORDER BY apellido");          
                if ($result->num_rows != 0) {
                    $autores=[];
                    while ($fila = $result->fetch_object()) {
                        $autores[]=$fila;
                    }//while
                }//if
           
            $db->close();
            return $autores;
        }//getAll
    }//autores
