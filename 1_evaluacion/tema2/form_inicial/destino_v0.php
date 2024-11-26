<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario</title>
</head>
<body>

<h1>Envío de datos mediante formularios</h1>
    <?php
/*Cuando el usuario envía datos a través de un formulario hacia el servidor, el servidor
los almacena en forma de array.Existen varios arrays predeterminados en el servidor

- $_POST : recoge datos enviados por método post (con post no salen los datos )
- $_GET : recoge datos enviados por método get (con get salen los datos en la url)
- $_REQUEST : recoge tanto los datos enviado por post como por get

*/
echo "Recibido por método POST <br/>";
print_r($_POST);

//Para ver que método se usa
echo "<br/>";
if($_GET) echo"<br/>Análisis: GET<br/>";//con isset no funciona(ya el nombre de variable existe) y empty tampoco ?
else echo "<br/>Análisis: POST<br/>";//Vamos a usar sin las funciones asi transforma el array a boolean, si está vacío a false si no a true.
    ?>
<!--Vamos a escribir un ejemplo de php embebido.Conseguimos cerrar el php escribir algo en html y volver a 
escribir php y cerrarlo. -->
<P>Recibido por $_GET...<?php print_r($_GET);?></p>
<P>Recibido por $_REQUEST...<?php print_r($_REQUEST);?></p>

<!--Aprendemos ahora en conclusión que sólo queremos usar POST ya que GET y REQUEST salen datos del formulario
ya que REQUEST da tanto get como post.Nunca procesaremos más que POST-->

</body>
</html>