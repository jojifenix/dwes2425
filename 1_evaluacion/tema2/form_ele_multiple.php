<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulario_eleccion_multiple</title>
</head>

<body>

<from method="POST" action=<?php echo $_SERVER['PHP_SELF'];?>>
    Lenguajes de programación:<br/><br/>
    <select name=langs1[] multiple=true>
        <option value=c>C</option>
        <option value=c++>C++</option>
        <option value=java>Java</option>
        <option value=python>Python</option>
        <option value=php>PHP</option>
        <option value=js>Javascript</option>
    </select>

    <br7> <br/> <br/>
    <input type=checkbox name=langs2[] value=c/>C
    <input type=checkbox name=langs2[] value=c++/>C++
    <input type=checkbox name=langs2[] value=java/>Java
    <input type=checkbox name=langs2[] value=python/>Python
    <input type=checkbox name=langs2[] value=php/>PHP
    <input type=checkbox name=langs2[] value=js/>Javascript

    
    <br7> <br/> <br/>
<?php
    define('BR',"<br/>");
    include("data/login.trad.inc.php");

    foreach(LANGS as $k=>$v){
        $b="<input type=submit name=b_langs[".$k."]";
        $b.=" value=".$v['name']."/>";
        echo $b;
    }
?>
<br/>
<input type=submit name=b_form value=ENVIAR/>
</form>
<?php
echo BR;BR;
if(isset($_POST)) print_r($_POST);

if(isset($_POST['b_langs'])){
    
}




?>

</body>
</html>