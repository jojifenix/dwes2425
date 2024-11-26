
<?php
include "../tema2/data_moneda/cambio.inc.php";



/* FUNCIONES
 
 La utilidad es para reutilizar código(independizar las vistas resultantes nos va a permitir
 mantener mejor la página)*/

function volver(){
    echo"<br><a href='".$_SERVER['PHP_SELF']."'>CONTINUAR</a>";
    /*Se llame como se llame el script que le invoca le redirige a si mismo
    si queremos algún archivo especifico ya que el ejercicio no sea sobre si mismo pues ponemos la ruta
    Sólo en el ejercicio de ejer_form_moneda_cambio.php lo usamos, en el otro de moneda si ponemos la redirección.
     
                                   <a href='".$_SERVER['PHP_SELF]."'> 
     
    */
    

}
    
function form(){
    
    //Tenemos que cambiar las comillas dobles por simples ya que echo funciona con las dobles.
    /*Quitamos la parte de php dentro de action ya que estamos ahora si en php solo escribimos la parte de 
    la variable de php $_SERVER*/
    echo " 
    <form method='POST' action='".$_SERVER['PHP_SELF']."'>
        <label>Cantidad de dinero:</label>
        <input type='number' name='cant' min=0 max=50000><br><br>
        <label>Selecciona una opción:</label>
            <select name='moneda'>";

    foreach(VALS as $k=>$fila)
        echo"<option value='$k'>".$fila["literal"]."</option>";

    echo"   </select> 
        <input type='submit' name= 'CAMBIAR'>
    </form>";
}
function error(){
    echo"<br/> Acceso incorrecto";
    volver();
}
function mensaje($cant,$mon){

    $cambio=$cant*$mon["tipo"];

    echo "<br/> $cant EUROS equivalen a $cambio".$mon["literal"];  
    volver();
}

function validar($cant){
  
    if(!is_numeric($cant)||$cant<0){
        echo"<br/> la cantidad debe ser mayor que cero";
        return false;}
    elseif($cant>MAX_CANT){
        echo"<br/> la cantidad máxima es".MAX_CANT;
        return false;
   
    }
    return true;
}


               ?>