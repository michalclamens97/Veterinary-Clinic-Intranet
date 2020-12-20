<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();
comprobarUsuario();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$usuario = limpiarDatos($_POST['usuario']);


 	$statement = $conexion->prepare('DELETE FROM login WHERE USUARIO = :usuario');
 	$statement->execute(array(':usuario'=>$usuario));
 	header('location:index_administracion.php?eliminado');
 		
 }else{

	$statement = $conexion->prepare('SELECT * FROM login WHERE USUARIO != "admin" ');
	$statement->execute();
	$resultado = $statement->fetchAll();
 }


require'views/eliminar_usuario.view.php';
 ?>