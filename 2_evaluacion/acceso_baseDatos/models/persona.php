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



        public static function save($item){
            $db=new mysqli("localhost:3306", "root", "root", "books");
            $q="INSERT INTO personas (nombre,apellido,pais) 
                  VALUES ('"
                            .$item['nombre']."','"
                            .$item['apellido']."','"
                            .$item['pais']."')";
        
            $result=$db->query($q);
            if($result) $data['result']="Insercación realizada";
                else $data['error']="Error en la insercion"; 
                


            

            }
        }

