<!-- showAllLibros.php

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
        <h1>Listado de libros</h1>
        <table border ='1'>;

        <?php
             foreach ($Libros as $Libro){
                echo "<tr>
                         <td>.$Libros->titulo.</td>
                         <td>.$Libros->genero.</td>
                         <td>.$Libros->numPaginas.</td>
                         <td>.$Libros->nombre.</td>
                         <td>.$Libros->apellido.</td>";}

                //celdas con control de acciones
                echo "<td><a href='".$_SERVER['PHP_SELF']."'?action=formularioModificarLibro&idLibro=".$libro->idLibro."'>Modificar</a></td>";
                echo"<td><a href='".$_SERVER['PHP_SELF']."'?action=borrarLibro&idLibro=".$libro->idLibro."'>Borrar</a></td>";
                echo "</tr>";
        ?>

        </tr>
        </table>
        <p><a href='<?php echo $_SERVER['PHP_SELF']; ?> ?action=formularioInsertarLibros'>Nuevo</a></p>;
             <!--Que vista queremos que presente (action) mediante un parámetro .El enlace de antes nos
             hace la petición sólo pero action determina la vista que se ve-->
    
</body>
</html>

       