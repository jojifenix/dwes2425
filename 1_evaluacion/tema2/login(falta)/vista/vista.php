
<?php
include "../cambio/cambio.php";

function volver($lang="es"){
    $l=LANGS[$lang];// la fila de LANGS correspondiente al idioma seleccionado
    echo"<br><a href='".$_SERVER['PHP_SELF']."'>".strtoupper($l['next'])."</a>";
    echo"<br><a href= 'end_session.php'>".strtoupper($l['exit'])."</a>";
   
}
function login($lang="es"){
    $l=LANGS[$lang];
    echo" <from method='POST' action='".$_SERVER['PHP_SELF']."'>".
    $l["user"]."<br/>
    <input type='text' name='user' required placeholder='usuario'><br/>".
     $l["pass"]."<br/>
    <input type='password' name='pass' required placeholder='Contraseña'><br/>".
     $l["email"]."<br/>
    <input type='email' name='email' required placeholder='Correo'><br/>.
    <input type='submit' name='enviar' value='".strtoupper($l["submit"])."'>
    </form>";
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

function error($lang="es"){
    $l = LANGS[$lang];
    echo "<br/>" . $l['noaccess']; 
    volver();
}
function mensaje(){
}

function validar(){
  
}

               ?>