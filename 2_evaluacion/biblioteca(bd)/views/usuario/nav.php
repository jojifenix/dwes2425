<!--nav.php-->
    <hr/>                 
    <nav>
        <a href="<?php echo $_SERVER['PHP_SELF'];?>"> Inicio </a> ...
    <?php
    if(isset($_SESSION))
        echo "<a href=".$_SERVER['PHP_SELF']."?action=loginForm > Identificarse </a>";
    else
        echo "<a href=".$_SERVER['PHP_SELF']."?action=logOut > Desconectarse </a>";
    ?>
    </nav>
    <hr/>


