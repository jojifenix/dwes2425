<!--ejem8_bool.php-->

<?php

/*
la ser PHP débilmente tipado, cualquier variable puede ser interpretada 
como boolean, pero esto puede ser peligroso porque las conversiones nos
pueden dar algún susto.
Para mayor seguridad en las comparaciones, usar el operador ===
*/

/*
   FUNCIONES ISSET Y EMPTY

   isset comprueba si la variable ha sido definida
   empty comprueba si la variable está vacía
      (empty es lo mismo que el comparador igual a false)


*/
define("BR", "<br/>\n");

$v1= -5.3;
echo "-------------ISSET-EMPTY-----------------".BR;
if(isset($v1)) echo "$v1 ha sido definida".BR;
if(empty($v1)) echo "$v1 está VACÍA".BR.BR;
echo "-----------------------------------------".BR;
if($v1==true) echo "$v1 es TRUE 1".BR;
if($v1===true) echo "$v1 es TRUE 2".BR;//añade el === una comprobación de tipo(si no coindide tipo no mira los valores), el FALSE por ser distintos tipos

$v0= 0;
echo "-------------ISSET-EMPTY-----------------".BR;
if(isset($v0)) echo "$v0 ha sido definida".BR;
if(empty($v0)) echo "$v0 está VACÍA".BR.BR;
echo "-----------------------------------------".BR;
if($v0==false) echo "$v0 es FALSE 1".BR; //imprime
if($v0===false) echo "$v0 es FALSE 2".BR; //no imprime

$s0="";
echo "-------------ISSET-EMPTY-----------------".BR;
if(isset($s0)) echo "$s0 ha sido definida".BR;
if(empty($s0)) echo "$s0 está VACÍA".BR.BR;
echo "-----------------------------------------".BR;
if($s0==false) echo "String vacío es FALSE".BR; //imprime
if($s0=== false) echo "String vacío es FALSE".BR; //no imprime ( tenemos un string y boolean)

$s0="0";
echo "-------------ISSET-EMPTY-----------------".BR;
if(isset($s0)) echo "$s0 ha sido definida".BR;
if(empty($s0)) echo "$s0 está VACÍA".BR.BR;
echo "-----------------------------------------".BR;
if($s0==false) echo "String $s0 es FALSE".BR;//imprime

$s="1kjsah lh";
echo "-------------ISSET-EMPTY-----------------".BR;
if(isset($s)) echo "$s ha sido definida".BR;
if(empty($s)) echo "$s está VACÍA".BR.BR;
echo "-----------------------------------------".BR;
if($s==true) echo "String $s es TRUE".BR;
if($s===true) echo "String es TRUE 2".BR; //NO IMPRIME

$a= array();
echo "-------------ISSET-EMPTY-----------------".BR;
if(isset($a)) echo "El array ha sido definida".BR;
if(empty($a)) echo "El array está VACÍA".BR.BR;
echo "-----------------------------------------".BR;
if($a==false) echo "Array VACÍO es FALSE".BR;//imprime

$n= NULL;
echo "-------------ISSET-EMPTY-----------------".BR;
if(isset($n)) echo "$n ha sido definida".BR;
if(empty($n)) echo "$n está VACÍA".BR.BR;
echo "-----------------------------------------".BR;
if($n==false) echo "$n NULL es FALSE".BR;//imprime

/*
 DOS OPERADORES DE COMPARACIÓN: ==  Y  ===
    
    A)  === comprueba si el tipo es igual y no hace conversión de valores
    B)  == hace conversión de valores entre diferentes tipos (cualquier numero lo convierte a true menos el 0 que lo hace a false)
                                    (string vacio lo convierte a false y un string que tenga un 0 a false.
                                    String con cualquier cosa que no tenga 0 a false
                                    array vacio a false 
                                    null a false)


CONCLUSIÓN: 

   isset es true siempre que asignamos un valor excepto null
   empty se comporta igual que ==false

   var_dump(0 == false);        // true
var_dump('' == false);       // true
var_dump(null == false);     // true
var_dump([] == false);       // true
var_dump('0' == false);      // true
var_dump(1 == false);        // false


var_dump(empty(0));          // true
var_dump(empty(''));         // true
var_dump(empty(null));       // true
var_dump(empty([]));         // true
var_dump(empty('0'));        // true
var_dump(empty(1));          // false

Por qué == false y empty() son similares?
Ambas operaciones tienen resultados similares porque ambos consideran varios valores "falsos" o "vacíos" de manera laxa. En resumen, cualquier valor que sea considerado falso por PHP en el contexto de la comparación flexible == también será considerado vacío por la función empty()




*/










