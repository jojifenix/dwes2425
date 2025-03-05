<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method = "POST" action = <?php echo $_SERVER['PHP_SELF']; ?>>
        
        Lenguajes de programación: <br/>
        <select name=langs[] multiple=true>
            <option value=c> C </option>
            <option value=cpp> C++ </option>
            <option value=java> Java </option>
            <option value=python> Python </option>
            <option value=php> PHP </option>
            <option value=js> JavaScript </option>
        </select>

        <br/><br/><br/>

        <input type=checkbox name=langs2[] value=c> C
        <input type=checkbox name=langs2[] value=cpp> C++
        <input type=checkbox name=langs2[] value=java> Java
        <input type=checkbox name=langs2[] value=python> Python
        <input type=checkbox name=langs2[] value=php> PHP
        <input type=checkbox name=langs2[] value=js> JavaScript

        <br/><br/><br/>

        <input type=checkbox name=langs3[c] value=c> C
        <input type=checkbox name=langs3[cpp] value=cpp> C++
        <input type=checkbox name=langs3[java] value=java> Java
        <input type=checkbox name=langs3[python] value=python> Python
        <input type=checkbox name=langs3[php] value=php> PHP
        <input type=checkbox name=langs3[js] value=js> JavaScript

        <br/><br/><br/>

    

    <?php

        include "traducciones.php";

        foreach(LANGS as $k=>$v) {
            $b="<input type=submit name=b_langs[".$k."]";
            $b.=" value=".$v["name"].">";
            echo $b;
        }
        

    ?>
    
    <br/><br/><br/>

<input type=submit name=b_form value=Enviar>

    </form>

    <?php
    echo "<br/><br/><br/>";
    if (isset($_POST)) print_r($_POST);

    echo "<br/><br/><br/>";

    if (isset($_POST['b_langs'])) {
        $code = array_keys($_POST['b_langs'])[0];
        $l = LANGS[$code];
        
        echo "Traducir al " . $_POST['b_langs'][$code] . "<br/>";
        //echo "Traducir al " . $_POST['b_langs'][$k] . "<br/>";

        echo $l['exito'] . "<br/>";
    }
    ?>

</body>
</html>