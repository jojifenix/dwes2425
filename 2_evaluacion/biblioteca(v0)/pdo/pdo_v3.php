<!DOCTYPE html>
<!-- pdo_v3.php -->

<?php
require_once('modelo\productodao.inc.php');

$pdao= new productoDAO();

$prods= $pdao->getAll();
print_r($prods);

echo"<br/><br/>";

$p= $pdao->get(2);
print_r($p);


?>



