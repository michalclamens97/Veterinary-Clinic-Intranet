<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$raza = limpiarDatos($_POST['raza']);
 	$statement = $conexion->prepare('DELETE FROM especies_raza WHERE RAZA = :raza');
 	$statement->execute(array(':raza'=>$raza));
 	header('location:index_panel_general.php?razaEliminada');
 		
 }else{

	$statement = $conexion->prepare('SELECT * FROM especies');
	$statement->execute();
	$resultado = $statement->fetchAll();

 }


require'views/eliminar_raza.view.php';
 ?>