
<?php
class View{
   public function __construct(){}
        public static function render($viewName, $data=null){
            include("view/$viewName.php");
        
        }
}//class

?>
