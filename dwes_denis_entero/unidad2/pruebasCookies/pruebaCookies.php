<?php
/*
    Definir una cookie: setcookie(K,V)

    La primera vez escribe en inglés, y después en español.
    */

if (!isset($_COOKIE['lang'])) {
    setcookie('lang', 'es'); //pide al servidor que cree la cookie. 
    echo "There was upon a time...";
} else {
    echo "Érase una vez...          ";

    $_COOKIE['lang'] = "fr"; //No funciona porque estoy cambiando el valor en el servidor,
    //pero la cookie solo está en el navegador. Es el navegador quien la envía al servidor.

    //para cambiar una cookie, hay que sobreescribirla.
    setcookie('lang', 'fr'); //pide al servidor que cree la cookie. 
    echo "VALOR de la cookie lang..." . $_COOKIE['lang']; // -> el servidor le pide al navegador que le envíe la cookie.
    //Por eso, aunque cambiemos el valor, no funciona porque el servidor no devuelve
    // el valor que tiene el, sino el valor que tiene el navegador.
    //Para cambiar la cookie hay que hacerlo en el navegador.
}

//Para definirla, lo unico obligatorio es el nombre. Puede tener contenido vacío.
//"nombre", "contenido", "caducidad en UNIX", "ruta", "dominio", "seguridad"
