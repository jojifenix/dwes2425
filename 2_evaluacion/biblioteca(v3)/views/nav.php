<!--nav.php-->
<hr/>                 
    <nav> 
       
    <?php
        if(!isset($_SESSION)) session_start();

        if(isset($_SESSION['adm'])){//usuario admin
            echo "<a href=".$_SERVER['PHP_SELF']."?action=adminAll>Inicio...</a>";
        }else{//sin usuario logeado o con usuario no admin
            echo "<a href=".$_SERVER['PHP_SELF'].">Inicio...</a>";
        }


        if(isset($_SESSION['iduser'])){
            echo "<a href=".$_SERVER['PHP_SELF']."?action=logOut > Desconectarse </a>";
        }else{
            echo "<a href=".$_SERVER['PHP_SELF']."?action=loginForm > Identificarse </a>";
        }
        
        
        echo "</br>"; print_r($_SESSION); 
        
        
    ?>
    </nav>
<hr/>


