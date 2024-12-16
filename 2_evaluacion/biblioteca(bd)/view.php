<?php
class View {
    public function __construct(){}

    public static function render($viewName, $data=null){
        
        include("views/usuario/header.php");
        include("views/usuario/nav.php");
        include("views/$viewName.php");
        include("views/usuario/footer.php");
    }


}