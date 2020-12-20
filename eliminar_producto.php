<?php session_start();
require('admin/config.php');
require('functions.php');
comprobarSession();
$conexion = conexion($bd_config);
if (!$conexion) {
	echo "ERROR";
}

$producto = $_GET['producto'];
$statement = $conexion->prepare('DELETE FROM productos WHERE PRODUCTO = :producto');
$statement->execute(array(

	':producto' => $producto

	));
//Mando la variable eliminado para poder saber que ya se elimino el producto y mostrar una notificacion de exito en mostrar_productos_dataTable.php
 header('Location: mostrar_productos_dataTable.php?eliminado');
 ?>