<!-- libros.php -->  
<?php

    //Tenemos que poner try..catch a todos

    /*    verificar la conexión
    if(mysqli_connect_errno()){
    printf("Fallo en la conexion: $s\n",mysqli_connect_error());
    exit;}*/

    //Habilitar las excepciones en mysqli para usar try..catch
    mysqli_report(MYSQLI_REPORT_ERROR|MYSQLI_REPORT_STRICT);


    class Libro {
    

        public static function getAll() { //Es importante que sea estático ??
            $db = new mysqli("localhost", "root", "root", "books");
            // Buscamos todos los libros de la biblioteca
            $result = $db->query("SELECT * FROM libros
                                LEFT JOIN escriben ON libros.idLibro = escriben.idLibro
                                LEFT JOIN personas ON escriben.idPersona = personas.idPersona
                                ORDER BY libros.titulo, libros.idLibro");
                                //LEFT JOIN permite que en la parte izquierda de la unión sea nulo de manera que ahora podemos insertar libros que no tienen autor de la lista.Si ponemos INNER JOIN solo se podría con la condicion que aparece , no vale valor nulo
           

                // La consulta se ha ejecutado con éxito se deuvelve un cursor. Vamos a ver si contiene registros
                if ($result->num_rows != 0) {
                    $items=[];
                    // La consulta ha devuelto registros: vamos a mostrarlos
                    while ($fila = $result->fetch_object()) {         
                        $items[]=$fila;
                    }//while
                }//if
            $result->close();//liberar memoria
            $db->close();
            return $items;
        }//getAll

        public static function get(){

        }//get

        public static function save($item){
            $autores=$item['autor'];
            unset($item['autor']);

            try{

                $db=new mysqli("localhost:3306","root","root","books");
                $db->commit();//Iniciar transacción---si se hiciera rollback después iría hasta el commit anterior osea éste
                $q= "INSERT INTO libros (titulo,genero,pais,ano,numPaginas) 
                    VALUES ('"
                                .$item['librotitulo']."','"
                                .$item['genero']."','"
                                .$item['pais']."','"
                                .$item['ano']."','"
                                .$item['numPaginas']."')";

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
            
            }catch(mysqli_sql_exception $e){
                    echo "Error : ".$e->getMessage();
            }finally{$db->close();}

        }//save

        public static function filter(){
            $filtro=$_REQUEST["filter"];
            $db=new mysqli();

            if($result=$db->query("SELECT * FROM libros
                LEFT JOIN escriben ON libros.
                LEFT JOIN escriben ON"))
            if($result->num_rows==0){  
                $data[""] 
            }else{
                $items=[];//creo array para la vista
                while($fila=$result->fetch_object()){

                }
            }

        }//filter

        public static function delete($idLibro){
            $db=new mysqli();
            $db->query("DELETE FROM libros WHERE idLibro='$idLibro'");
            if($db->affected_rows==0){
                $data['error']="Ha ocurrido un error al borrar el libro.Por favor"
            }else{
                $data['mensaje']="Libro borrado con éxito";
            }
        }//delete

        public static function update($libro){
            try{
                $db=new mysqli();
                //Gestión de la transacción
                //Version orientada a objetos(invoca al métood el objeto)
                $db->autocommit(FALSE);//mysqli_autocommit($db,FALSE) PROGRAMACION ESTRUCTURADA(método recibe bd)
                $db->commit($db);//mysqli_commit($db) PROGRAMACION ESTRUCTURADA
                $q="UPDATE libros SET
                        titulo='".$libro['titulo']."',
                        genero='".$libro['genero']."',
                        pais='".$libro['pais']."',
                        ano='".$libro['ano']."',
                        numPaginas='".$libro['numPaginas']."'
                        WHERE idLibro=".$libro['idLibro'];
                $db->query($q);
                echo $q;
                if($db->affected_rows==1){
                    $db->query("DELETE")
                    foreach(){

                    }
                }
                //si todo va bien...CONFIRMAR TRANSACCION
                $db->commit();

            }catch(myqsli_sql_exception $e){
                echo "Error: ".$e->getMessage();
                //en caso de error...DESHACER TRNASACCION PARCIAL
                $db->rollback();
            }finally{$db->close();}








            
        }//update
    }//Libro

?>
                    



