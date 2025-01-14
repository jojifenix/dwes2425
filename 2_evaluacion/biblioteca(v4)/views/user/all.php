<h1>Listado de usuarios</h1>
<table border='1'>
    <?php

    $campos = get_object_vars($data['user_all'][0]); // Obtener nombres de propiedades

    echo "<tr>";
    foreach ($campos as $c=>$v) {
        echo "<th>$c</th>";
    }
    echo "</tr>";

    foreach($data['user_all'] as $user) {
        echo "<tr>";
        foreach ($campos as $c => $v) {
            echo "<td>" . ($user->$c) . "</td>";
        }

        //Acciones de admin
        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=userForm&idUser=" . $user->iduser . "'>Modificar</a></td>";
        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=userDelete&idUser=" . $user->iduser . "'>Borrar</a></td>";
    }

    echo "</tr>";

    //Accion de añadir


    ?>

</table>

<?php

if (isset($_SESSION['adm'])) {
    echo "<p><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm'>Nuevo</a></p>";
}
//nose ponerlo sin <?php pa que esten bien las comillas

?>