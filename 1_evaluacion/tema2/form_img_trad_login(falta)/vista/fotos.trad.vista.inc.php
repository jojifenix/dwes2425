<!-- fotos.trad.vista.inc.php -->
<?php

function form_lang(){

    $l= LANGS[$_SESSION["lang"]]; //la fila de LANGS correspondiente al idioma seleccionado

    echo " 
    <form method='POST' action= '".$_SERVER['PHP_SELF']."'>".
        $l["choose_lang"] //Elige tu idioma
       ."<select name='lang'>";

    foreach(LANGS as $k=>$fila)
            echo"<option value='".$k."'>".LANGS[$k]["name"]."</option>";
           
    echo"    </select>
       <input type='submit' name='b_lang' value= '"
       .strtoupper($l["translate"])."'>
    </form>\n";

}

function form_login(){

    $l= LANGS[$_SESSION["lang"]];
    
    echo "<div id= form_login>\n
    <form method='POST' action= '".$_SERVER['PHP_SELF']."'>".
       "<label for='username'>".$l["username"]."</label>".BR.
        "<input type='text' name='username' 
                placeholder='".$l["username"]."'>".BR.
       "<label for='email'>".$l["email"]."</label>\n".BR.
       "<input type='text' name='email' 
                 placeholder='".$l["email"]."'>".BR.
       "<label for='pwd'>".$l["pwd"]."</label>\n".BR.
       "<input type='password' name='pwd' 
                placeholder='".$l["pwd"]."'>".BR.
             
       "<input type='submit' name='b_login' value='".strtoupper($l["submit"])."'>
    </form>\n</div>";

}

function form_layout(){

    $l= LANGS[$_SESSION["lang"]]; //la fila de LANGS correspondiente al idioma seleccionado

    echo " 
    <form method='POST' action= '".$_SERVER['PHP_SELF']."'>"
       .$l["choose_layout"] 
       ."<select name='layout'>\n";

    for($i=2; $i<=5; $i++)
            echo"<option value='$i'>$i</option>\n";
           
    echo"    </select>
       <input type='submit' name='b_layout' value= '"
       .strtoupper($l["submit"])
       ."'>    </form>".BR;

}

function prompt_login(){

    $l= LANGS[$_SESSION["lang"]]; 

    echo " 
    <form method='POST' action= '".$_SERVER['PHP_SELF']."'>
     <input type='submit' name='b_prompt_login' value= '"
       .strtoupper($l["login"])
       ."'>    </form>";

}//function prompt_login

function prompt_exit(){

    $l= LANGS[$_SESSION["lang"]]; 

    echo " 
    <form method='POST' action= '".$_SERVER['PHP_SELF']."'>
     <input type='submit' name='b_prompt_exit' value= '"
       .strtoupper($l["exit"])
       ."'>    </form>".BR;

}//function prompt_exit

function cabecera(){

    $l= LANGS[$_SESSION["lang"]];
    
    echo "<h1>".$l["welcome"]; //personalizar
    if(isset($_SESSION['username'])) echo ", ".$_SESSION['username'];
    echo "</h1>";

    //botones de login y exit
    
    echo"<div id='prompt_login' style='width:20%;float:right;'>\n";
      prompt_login(); //bot�n para ver el form_login
    echo "</div>\n"; 
    echo"<div id='prompt_exit' style='width:20%;float:right;'>\n";
      prompt_exit();  //bot�n salir
    echo "</div>\n";
    
    //preferencias de traducci�n y layout
    echo"<div id='form_lang'>\n";
    form_lang();
    echo "</div>\n";
    echo"<div id='form_layout'>\n";
    form_layout();
    echo "</div>\n"; 
    
}//cabecera

function volver(){
    //pinta un elemento <a> para volver al script que la llam�
    //y OTRO para terminar la app

     $l= LANGS[$_SESSION["lang"]];

    echo"<br><a href='fotos_app_trad.php'>"
        .strtoupper($l['next'])."</a>"; 
     
    echo"<br><a href='fotos_app_trad.php'>"
        .strtoupper($l['exit'])."</a>";
    // header("Location: fotos_app_trad.php");


}//volver

function error(){

     $l= LANGS[$_SESSION["lang"]];

     echo"<br/> ".$l["loginerror"].BR;
     volver($lang="es"); }//error

function mensaje(){

    $l= LANGS[$_SESSION["lang"]];
  
    /*if(!isset($_SESSION["username"]))      
        echo"<br/> ".$l["welcome"]." nombre ";
    else 	*/
    if(!isset($_SESSION["username"])){
        echo "<br/> ".$l["loginerror"];
        volver(); 
    }//if
}//mensaje
    
 // Define the validar_user function
function validar_user($email, $password) {
    // Add your user validation logic here
    // For example, check against a hardcoded user or a database
    return true; // Change this to actual validation logic
}

function get_dir($email) {
    // Define the logic to get the directory based on the email
    // For example, return a directory name based on the email
    return 'users/' . md5($email);
}


function validar_format($archivo) {
    $allowed_formats = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = pathinfo($archivo, PATHINFO_EXTENSION);
    return in_array(strtolower($file_extension), $allowed_formats);
}

function ver(){
        
    $midir= isset($_SESSION['dir'])? $_SESSION['dir']: "public";

    if(!file_exists($midir)) mkdir($midir, 0777); //crear el directorio

    //echo $midir.BR;

    $numcols= $_SESSION['layout'];

    if ($gestor = opendir($midir)) {
        echo "<br/> <table border=1>";
         $i=0;
         
        while (false !== ($archivo = readdir($gestor))) //leer archivo a archivo 
        {
	        //if ($archivo!="." && $archivo!=".."&&validar($archivo)) 
		
	        if (validar_format($archivo)) { 
		    //solo se visualizan las im�genes de los formatos permitidos
				
		    if (($i%$numcols)==0) echo "<tr>"; //inicio fila
		
		    echo "<td>";
		
		    echo "<a href=$midir/$archivo>
				<img src=$midir/$archivo width=100 height=100>
			    </a>";
		    echo "</td>";
		
		    if (($i%$numcols)==$numcols-1) echo "</tr>"; //termino fila
		
		    $i++;
	        }//if
        }//while

    echo "</table>";
    closedir($gestor);
    }//if

}//function ver

