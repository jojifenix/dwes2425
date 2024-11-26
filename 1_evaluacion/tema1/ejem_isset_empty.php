<!--ejercicio_entrega-->

<?php

//isset : determina si una variable está definida y no es null.

$variable = 6;
if(isset($variable)){
      echo " La variable importada está definida y no es nula ,
            se imprimirá en pantalla";
}

$a = "hola";
unset($a);
if (isset($variable,$a)){
      echo "La variable $a no está definida así que no se imprimirá ninguna en pantalla";
}

$c=null;
if (isset($c)){
      echo " La variable $c es nula así que no se imprimirá en pantalla";
}

//empty : Determina si una variable es considerada vacía. Una variable se considera vacía si no existe o si su valor es igual a false. empty() no genera una advertencia si la variable no existe.

$var = 0;
$g= '';

// Se evalúa a true ya que $var está vacia 
echo "<br/>";
echo "<br/>";
if (empty($var)) {
    echo "$var es o bien 0, vacía, o no se encuentra definida en absoluto";
}
//usamos un ejemplo de valor vacío.
echo "<br/>";
echo "<br/>";
if (empty($g)) {
   echo "$g es o bien 0, vacía, o no se encuentra definida en absoluto";
}

// Se evalúa como true ya que $var está definida.Aquí podemos ver como isset solo necesita que esté definido ese valor anterior mientras que empty no lo considera al ser 0 
echo "<br/>";
echo "<br/>";
if (isset($var)) {
    echo "$var está definida a pesar que está vacía";
}
?>











