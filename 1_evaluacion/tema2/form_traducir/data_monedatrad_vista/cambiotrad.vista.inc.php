
<?php
include "../formulario_traducir/data_monedatrad/cambiotrad.inc.php";









function volver($lang="es"){
    $l=LANGS[$lang];// la fila de LANGS correspondiente al idioma seleccionado
    echo"<br><a href='".$_SERVER['PHP_SELF']."'>".strtoupper($l['next'])."</a>";
    echo"<br><a href= 'end_session.php'>".strtoupper($l['exit'])."</a>"; 
}

function form_lang($lang="es"){//podemos escribir valor por defecto( si llamamos a form_lang() tendrá es valor "es")
    $l=LANGS[$lang];// la fila de LANGS correspondiente al idioma seleccionado

    echo " 
    <form method='POST' action='".$_SERVER['PHP_SELF']."'>".
        $l["choose_lang"]//Elige tu idioma
        ."<select name='lang'>";

    foreach(LANGS as $k=>$fila)
        echo"<option value='".$k."'>".LANGS[$k]["name"]."</option>";

    echo"
        </select>
        <input type='submit' name= 'b_lang' value='".strtoupper($l["translate"])."'>
    </form>".BR;

//Hemos conseguido tener todo referenciado al idioma, no escribimos nada.
}
function form($lang="es"){

    $l=LANGS[$lang];
    echo " 
    <form method='POST' action='".$_SERVER['PHP_SELF']."'>".
        $l["quantity"]."<br/>
        <input type='number' name='cant' min=0 max=". MAX_CANT.">".BR.
        $l["dest_currency"]."<br>
            <select name='moneda'>";

    foreach(VALS as $k=>$fila)
        echo"<option value='$k'>".$fila["literal"]."</option>";

    echo"   </select> 
        <input type='submit' value='".strtoupper($l["submit"])."'>
    </form>";
}
function error($lang="es"){
    $l = LANGS[$lang];
    echo "<br/>" . $l['noaccess']; 
    volver();
}
function mensaje($lang="es" , $cant,$mon){

    $l=LANGS[$lang];

    $cambio=$cant*$mon["tipo"];

    echo "<br/> $cant EUROS ".$l["equivalence"]." $cambio ".$mon["literal"];  
    volver();
}

function validar($cant, $lang="es"){
  
    if(!is_numeric($cant)||$cant<0){
        $l = LANGS[$lang];
        echo"<br/>".$l["sgtzero"];
        return false;}
    elseif($cant>MAX_CANT){
        echo"<br/> la cantidad máxima es".MAX_CANT;
        return false;
   
    }
    return true;
}


               ?>