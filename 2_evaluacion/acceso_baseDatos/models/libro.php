<!-- libros.php -->  
<?php
    class Libro {
       
    
        public static function getAll() { //Es importante que sea estático ??
            $db = new mysqli("localhost", "root", "root", "books");
            // Buscamos todos los libros de la biblioteca
            $result = $db->query("SELECT * FROM libros
                                LEFT JOIN escriben ON libros.idLibro = escriben.idLibro
                                LEFT JOIN personas ON escriben.idPersona = personas.idPersona
                                ORDER BY libros.titulo");
                                //LEFT JOIN permite que en la parte izquierda de la unión sea nulo de manera que ahora podemos insertar libros que no tienen autor de la lista.Si ponemos INNER JOIN solo se podría con la condicion que aparece , no vale valor nulo
           

                // La consulta se ha ejecutado con éxito se deuvelve un cursor. Vamos a ver si contiene registros
                if ($result->num_rows != 0) {
                    $items=[];
                    // La consulta ha devuelto registros: vamos a mostrarlos
                    while ($fila = $result->fetch_object()) {
                        $items[]=$fila;
                    }//while
                }//if
            $db->close();
            return $items;
        }//getAll


        public static function save($libro){
            $autores=$libro['autor'];
            unset($libro['autor']);
            $db=new mysqli("localhost:3306","root","root","books");

            $db->commit();//---si se hiciera rollback después iría hasta el commit anterior osea éste
            $q= "INSERT INTO libros (titulo,genero,pais,ano,numPaginas) 
                  VALUES ('"
                            .$libro['librotitulo']."','"
                            .$libro['genero']."','"
                            .$libro['pais']."','"
                            .$libro['ano']."','"
                            .$libro['numPaginas']."')";
            echo "$q <br/>";

            $db->query($q);

            if ($db->affected_rows == 1) {//libro insertado
                $result = $db->query("SELECT MAX(idLibro) AS ultimoIdLibro FROM libros");
                $idLibro = $result->fetch_object()->ultimoIdLibro;
                print_r($autores);

                foreach ($autores as $id) {
                    //una inserción en escriben por cada autor
                    $q="INSERT INTO escriben(idLibro, idPersona) 
                                VALUES(
                                 $idLibro, //calculado como ultimoLibro 
                                 $id)";
                                 //en este caso no usamos comillas simples porque los id en ambas tablas son numéricos ??
                                //dentro de comillas magicas no se puede poner arrays hay que buscar maneras.Dem
                    echo "$q <br/>";
                    
                    $db->query($q);
                    if($db->affected_rows != 1) $db->rollback();
                }
                
            } //if
            $db->commit();//terminamos
              

            
        }
    }//Libro

?>
                    



