<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}



 	$procedimiento = limpiarDatos($_GET['procedimiento']);
 	$statement = $conexion->prepare('DELETE FROM procedimientos_consulta WHERE PROCEDIMIENTO = :procedimiento');
 	$statement->execute(array(':procedimiento'=>$procedimiento));
 	header('location:mostrar_procedimientos_dataTable.php?eliminado');
 		



 ?>