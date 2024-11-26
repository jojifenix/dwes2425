<!DOCTYPE html>
<!--
Ejercicio : app con las siguientes especificaciones:
    - formulario de login
    - una sola página SAP
    - traducible
    - archivo users.txt con líneas en formato mail nombre pwd
    - validación del usuario contra los datos de users.txt
    - Al entrar por primera vez
             *muestra un mensaje para que el usuario introduzca sus datos
             *Formulario de login
    - Si el usuario es validado 
             *mostrará una cabecera personalizada con el nombre del usuario
             *desaparece el form de login
             *un enlace <a> para salir y terminar la sesión   
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_login</title>
</head>
    <h1>Login</h1>
<body>
    
<?php
session_start();
include 'vista.php'; // Incluimos el archivo de funciones

// Definimos el idioma por defecto
if (!isset($_SESSION['idioma'])) {
    $_SESSION['idioma'] = 'es'; // Español como idioma por defecto
}

// Cambiamos el idioma si se ha indicado
if (isset($_GET['cambio_idioma'])) {
    cambiarIdioma($_GET['cambio_idioma']);
}

// Comprobamos si el usuario ya está logueado
if (isset($_SESSION['usuario'])) {
    echo "<h1>" . _("Bienvenido, " . $_SESSION['usuario']['nombre']) . "</h1>";
    echo '<a href="logout.php">' . _("Salir") . '</a>';
} else {
    // Mensaje para el usuario si no ha iniciado sesión
    echo "<h1>" . _("Por favor, inicie sesión") . "</h1>";

    // Formulario de inicio de sesión
    echo '<form method="POST" action="ejercicio_login.php">';
    echo '<label>' . _("Correo:") . '</label><input type="email" name="email" required><br>';
    echo '<label>' . _("Contraseña:") . '</label><input type="password" name="pwd" required><br>';
    echo '<input type="submit" value="' . _("Iniciar Sesión") . '">';
    echo '</form>';

    // Procesar el formulario de inicio de sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $usuarios = validarUsuario($email, $pwd);

        if ($usuarios) {
            $_SESSION['usuario'] = $usuarios; // Guardamos el usuario en la sesión
            header("Location: ejercicio_login.php"); // Redirigimos a la misma página
            exit();
        } else {
            echo "<p>" . _("Credenciales incorrectas. Intente de nuevo.") . "</p>";
        }
    }
}
?>


?>
</body>
</html>

