<nav>
    <?php
    echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=libroAll >Gestion de Libros</a><br>";
    echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=userAll >Gestión de usuarios</a><br>";
    echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=prestamoAll >Gestión de préstamos</a><br>";
    ?>
</nav>