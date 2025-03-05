<hr />
<nav> Menu de navegacion
    

    <?php

    if (!isset($_SESSION)) session_start();
    
    echo "<br>";
    print_r($_SESSION);
    echo "<br>";




    if (isset($_SESSION['adm'])) {
        echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=adminAll >Inicio....</a>";
    } else {
        echo "<a href= " . $_SERVER['PHP_SELF'] . ">Inicio....</a>";
    }

    if (isset($_SESSION['iduser'])) {
        //Añadido 14012025
        echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=libroCart > Mis libros </a>"; 
        echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=logOut >Desconectarse</a>";
    } else {
        echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=loginForm >identificarse</a>";
    }



    // if (isset($_SESSION['iduser'])) {
    //     echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=";
    //     if (isset($_SESSION['adm'])) echo "adminAll";
        

    //     echo "'<inicio...</a>";


    //     echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=logOut >Desconectarse</a>";
    // } else {

    //     echo "<a href= " . $_SERVER['PHP_SELF'] . ">Inicio...</a>"; //Esta linea no se por que la tiene la profe
    //     echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=loginForm >identificarse</a>";
        

    // }

 




    // if (!isset($_SESSION)) {
    //     echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=loginForm >login</a>";
    // } else {
    //     echo "<a href= " . $_SERVER['PHP_SELF'] . "?action=logOut >logout</a>";
    // }
    ?>
</nav>
<hr />