
<?php
include "../form_traducir/data_monedatrad/cambiotrad.inc.php";

//Creamos la clase Vista
class Vista{
    //Definimos su propiedad $lang
    public $lang;
    /*Creamos el constructor que recibe datos $lang.
    
    El constructor sirve para crear 
    instancias de una clase(objetos).Siempre lo creamos dentro de la clase.La ventaja que tenemos respecto a este 
    ejercicio anterior en la 1º eva, es que con objetos miramos primero los datos ,eliminamos las partes
    comunes de los métodos(código repetido).También agilizamos ya que no tendremos que ir en cada método al array
    grande para pillar la parte que queremos en cada método(la misma)

    métodoEjemploRepetido($lang="es"){
      $l=LANGS[$this->lang]
      ....
    }  
    */

    /*public function Vista($lang="es"){
        $this->lang=LANGS[$lang];}            ES OTRA MANERA DE HACER UN CONSTRUCTOR*/
        
    
    public function __construct(){
        
        $this->lang=isset($_SESSION['lang']) ? LANGS[$_SESSION['lang']] : LANGS["es"];}
        
        

    public function setLang($l){
        $this->lang=LANGS[$l];}
        


    //Métodos de la clase
  
    /*Cambios que realizamos son :
        - volver() no tiene argumento ya que todos pillan el idioma del objeto Vista
        - Cuando llamas a un método dentro de otro usamos this->volver()
        - Todas las partes dentro de cada método que mencionamos $l escribimos $this->l ya que representamos 
        la variable l dentro de la clase diciendo $this->l*/

    function form_lang(){
     
    
        echo " 
        <form method='POST' action='".$_SERVER['PHP_SELF']."'>".
            $this->lang["choose_lang"]
            ."<select name='lang'>";
    
        foreach(LANGS as $k=>$fila)
            echo"<option value='".$k."'>".LANGS[$k]["name"]."</option>";
    
        echo"
            </select>
            <input type='submit' name= 'b_lang' value='".strtoupper( $this->lang["translate"])."'>
        </form>".BR;
    
    
    }
 
    public function form(){
        echo " 
        <form method='POST' action='".$_SERVER['PHP_SELF']."'>".
        $this->lang["quantity"]."<br/>
            <input type='number' name='cant' min=0 max=". MAX_CANT.">".BR.
            $this->lang["dest_currency"]."<br>
                <select name='moneda'>";
    
        foreach(VALS as $k=>$fila)
            echo"<option value='$k'>".$fila["literal"]."</option>";
    
        echo"   </select> 
            <input type='submit' value='".strtoupper($this->lang["submit"])."'>
        </form>";
    }
    public function error(){
        echo "<br/>". 
        $this->volver();
    }
    public function mensaje($cant,$mon){

    
        $cambio=$cant*$mon["tipo"];
    
        echo "<br/> $cant EUROS ". $this->lang["equivalence"]." $cambio ".$mon["literal"];  
        $this->volver();
    }
    public function validar($cant){
      
        if(!is_numeric($cant)||$cant<0){
            echo"<br/>". $this->lang["sgtzero"];
            return false;}
        elseif($cant>MAX_CANT){
            echo"<br/> la cantidad máxima es".MAX_CANT;
            $this->volver();
            return false;
       
        }
        return true;
    }
    public function volver(){
    
        echo"<br><a href='".$_SERVER['PHP_SELF']."'>".strtoupper( $this->lang['next'])."</a>";
        echo"<br><a href= 'end_session.php'>".strtoupper( $this->lang['exit'])."</a>"; 
    }  
}
      
               ?>