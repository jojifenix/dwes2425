<!DOCTYPE html>
<!--header.php-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>        
    <hr/>                 
    <nav>Menú de navegación

        <a href="<?php echo $_SERVER['PHP_SELF'];?>">Home...</a>
        <a href="<?php echo $_SERVER['PHP_SELF']."?action='loginForm'";?>>Login</a>


    </nav>
    <hr/>
</body>
</html>

