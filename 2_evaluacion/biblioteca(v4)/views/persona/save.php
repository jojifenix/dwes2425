<h1>Introduce los datos</h1>
<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='get'>
    Nombre: <input type="text" name="nombre"><br>
    Apellido: <input type="text" name="apellido"><br>
    Pais: <input type="text" name="pais"><br>
    <input type='hidden' name='action' value='personaSave'>
    <input type='submit'>
</form>
<p><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">Volver</a></p>