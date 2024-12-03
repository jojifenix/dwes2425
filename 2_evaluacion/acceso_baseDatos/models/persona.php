<!-- autores.php

-->

<?php
    class Persona{
       
        public static function getAll() { 
            $db = new mysqli("localhost:3306", "root", "root", "books");
            $result = $db->query("SELECT * FROM personas ORDER BY apellido");          
                if ($result->num_rows != 0) {
                    $items=[];
                    while ($fila = $result->fetch_object()) {
                        $items[]=$fila;
                    }//while
                }//if
           
            $db->close();
            return $items;
        }//getAll
    }//autores
