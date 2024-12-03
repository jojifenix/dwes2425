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
             foreach ($data['libro_all'] as $libro){
                echo "<tr>
                         <td>.$libro->titulo.</td>
                         <td>.$libro->genero.</td>
                         <td>.$libro->numPaginas.</td>
                         <td>.$libro->nombre.</td>
                         <td>.$libro->apellido.</td>
                         <td><a href='".$_SERVER['PHP_SELF']."'?action=libroSave&idLibto=".$libro->idLibro."'>Modificar</a></td>;
                         <td><a href='".$_SERVER['PHP_SELF']."'?action=libroDelete&idLibro=".$libro->idLibro."'>Borrar</a></td>;
                         </tr>";}
        ?>

        </tr>
        </table>
        <p><a href='<?php echo $_SERVER['PHP_SELF']; ?> ?action=libroForm'>Nuevo</a></p>;
             <!--Que vista queremos que presente (action) mediante un parámetro .El enlace de antes nos
             hace la petición sólo pero action determina la vista que se ve-->
    
</body>
</html>

       