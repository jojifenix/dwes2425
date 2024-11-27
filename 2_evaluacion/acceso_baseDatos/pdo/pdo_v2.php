<!DOCTYPE html>
<!-- pdo_v2.php -->

<?php

require_once('modelo\conn.inc.php');

/*Utilizamos la clase Conn para conectar*/

try{
	//la clase Conn está configurada para lanzar excepciones pdo
	$conn= new Conn();
	$bd= $conn->getConn();
	
	echo"<h1>Conectado</h1>";
	
	//Ejecutar una consulta no preparada
	
	$sql= "SELECT * FROM productos";	
	$prods= $bd->query($sql);
	$conn-> close();
	
	print_r($prods);
	
	$fila= $prods->fetch(PDO::FETCH_ASSOC);
	print_r($fila);
	
	echo "<br/><br/>";
	
	$result= $prods->fetchAll(PDO::FETCH_ASSOC);//FETCH_BOTH, FETCH_NUM	
	print_r($result);
	

}catch (PDOException $e){
	
	echo"<h1>Error</h1>";
	
}



?>



