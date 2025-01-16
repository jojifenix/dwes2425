<?php
DEFINE("MSSGS", [
    'borrowed'=>'Prestado',
    'empty'=>'No hay libros en la base de datos',
    'maxcart'=>"Ha alcanzado el máximo de reservas.Acceda a <a href=%s?action=libroCart > Mis libros...</a> para ver las acciones posibles",
    'maxbooks'=>"El número máximo de reservas es %s, el número máximo de prestamos es %s",
    'new'=>'Nuevo',
    'reserve'=>'Reservar',
    'reserved'=>'Reservado',
    "loginerror"=>'Datos incorrectos. Vuelva a intentarlo',
    'unavailable'=>'No disponible',
]);
DEFINE("MAXBOOKS", 3); //maximo prestados
DEFINE("MAXCART", 6);   //maximo entre prestados y reservados
DEFINE("RESERVADO", 0);
DEFINE("PRESTADO", 1);
?>

