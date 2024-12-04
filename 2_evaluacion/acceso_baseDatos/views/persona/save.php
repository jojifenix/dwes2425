<!-- persona/save.php
-->
<h1>Alta de autores</h1>
    <form action = '<?php $_SERVER['PHP_SELF'] ?>' method = 'get'>
            Nombre:<input type='text' name='nombre'><br>
            Apellido:<input type='text' name='apellido'><br>
            País:<input type='text' name='pais'><br>
        
            <input type='hidden' name='action' value='personaSave'>
	        <input type='submit'>

    </form>";

<p><a href='<?php echo $_SERVER['PHP_SELF'];?>'>Volver</a></p>";

        

