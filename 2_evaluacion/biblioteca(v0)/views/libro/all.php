<!-- libro/all.php

    Clase del modelo
    Extraer todo lo que sea vista
    Ahora no hacemos fecth, la vista recibe un array $Libros con los datos
    Itera $Libros para generar la tabla
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>acceso_base_datos</title>
</head>
<body>
<!--Lo que se imprime una vez con html-->
        <h1>Listado de libros</h1>
        
        <!--form de búsqueda-->
        <form action='<?php echo $_SERVER['PHP_SELF'];?>'>
								<input type='hidden' name='action' value='libroFilter'>
                            	<input type='text' name='textoBusqueda'>
								<input type='submit' value='Buscar'>
        </form><br>";
        <!--tabla con el listado -->

        <table border ='1'>;

        <?php
        //lo que exige iterar un arry usamos php 


        
        $actual=NULL;//el primer libro debe tener fila nueva si o si
        $autores="";
        

             foreach ($data['libro_all'] as $libro){
                if($libro->idLibro!=$actual->idLibro){//nuevo libro
                echo "<tr>
                         <td>".$actual->idLibro."</td>
                         <td>".$actual->titulo."</td>
                         <td>".$actual->genero."</td>
                         <td>".$actual->numPaginas."</td>
                         <td>".$autores."</td>
                         <td><a href='".$_SERVER['PHP_SELF']."?action=libroSave&idLibto=".$actual->idLibro."'>Modificar</a></td>
                         <td><a href='".$_SERVER['PHP_SELF']."?action=libroDelete&idLibro=".$actual->idLibro."'>Borrar</a></td>
                         </tr>";

                         $actual=$libro;
                         $autores="";
                         
                }

                //autor con formato apellido,nombre
                //en una misma celda, cada autor en un alínea diferente

                if(!$autores) echo "<td>"; //inicio casilla
                //acumulo autor

                $autores.=$libro->apellido.",".$libro->nombre;

                        
            }   
        
        
        
        
        ?>




        </tr>
        </table>
        <p><a href='<?php echo $_SERVER['PHP_SELF']; ?> ?action=libroForm'>Nuevo</a></p>;
             <!--Que vista queremos que presente (action) mediante un parámetro .El enlace de antes nos
             hace la petición sólo pero action determina la vista que se ve-->
    
</body>
</html>

       