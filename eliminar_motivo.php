<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$motivo = limpiarDatos($_POST['motivo']);
 	$statement = $conexion->prepare('DELETE FROM motivo_consulta WHERE MOTIVO = :motivo');
 	$statement->execute(array(':motivo'=>$motivo));
 	header('location:eliminar_motivo.php?eliminado');
 		
 }else{

	$statement = $conexion->prepare('SELECT * FROM motivo_consulta');
	$statement->execute();
	$resultado = $statement->fetchAll();
 }


require'views/eliminar_motivo.view.php';
 ?>