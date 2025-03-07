<h1 class="user-list-title">Listado de usuarios</h1>
<table class="user-table">
    <?php
    $campos = get_object_vars($data['user_all'][0]); // Obtener nombres de propiedades

    echo "<tr class='table-header'>";
    foreach ($campos as $c=>$v) {
        echo "<th>$c</th>";
    }
    echo "<th colspan='2'>Acciones</th>";
    echo "</tr>";

    foreach($data['user_all'] as $user) {
        echo "<tr>";
        foreach ($campos as $c => $v) {
            echo "<td>" . ($user->$c) . "</td>";
        }

        // Acciones de admin
        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=userForm&idUser=" . $user->iduser . "' class='action-link'>Modificar</a></td>";
        echo "<td><a href='" . $_SERVER['PHP_SELF'] . "?action=userDelete&idUser=" . $user->iduser . "' class='action-link delete-link'>Borrar</a></td>";
    }
    echo "</tr>";
    ?>
</table>

<?php
if (isset($_SESSION['adm'])) {
    echo "<p class='add-new-link-p'><a href='" . $_SERVER['PHP_SELF'] . "?action=libroForm' class='add-new-link'>Nuevo</a></p>";
}
?>
