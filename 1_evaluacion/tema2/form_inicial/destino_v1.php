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
/*Antes de trabajar los datos se pueden hacer validaciones, aunque es más eficiente hacerlas en cliente que
en servidor
*/



print_r($_POST);



//                               M E N S A J E     A T E N C I Ó N 



//Nuestro isset comprueba que en el array $_POST existe un elemento nombre, pwd , email...
/*if (!isset($_POST["nombre"])) echo"Error : el campo nombre es obligatorio";
elseif (!isset($_POST["pwd"])) echo"Error : la contraseña es obligatoria";
elseif (!isset($_POST["email"])) echo"Error : el correo es obligatorio";
else echo "Datos correctos";*/

//sería lo mismo buscar un empty que un !isset
/*if (empty($_POST["nombre"])) echo"Error : el campo nombre es obligatorio";
elseif (empty($_POST["pwd"])) echo"Error : la contraseña es obligatoria";
elseif (EMPTY($_POST["email"])) echo"Error : el correo es obligatorio"*/



//                              B U C L E    A T E N C I Ó N



/*$campos=array_keys($_POST);

$datos=true;

foreach($campos as $campo)
    if(empty($_POST[$campo])){
        $datos=false;
        echo"<br/>El campo $k no puede estar vacío";
        break;//salgo del bucle
    }

    if($datos) echo "<br/>Datos correctos";*/



//                                 V A L I D A C I O N E S

                        
/*AUNQUE SE SUELE HACER ÉSTO DESDE EL CLIENTE, vamos a ver como sería desde el servidor(NO SE VALIDA EN EL 
SERVIDOR RECUERDA)

filter_var permite limpiar cualquier carácter no deseado, en los datos de entrada y 
además VALIDAR el tipo de dato*/

$nombre=filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);
$contraseña=filter_var($_POST["pwd"], FILTER_SANITIZE_STRING);
$email=filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

//FILTER_SANITIZE_URL
//FILTER_SANITIZE_NUMBER_INT



    ?>
</body>
</html>