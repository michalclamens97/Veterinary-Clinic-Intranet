<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$especie = limpiarDatos($_POST['especie']);
 	//ELIMINO LA ESPECIE
 	$statement = $conexion->prepare('DELETE FROM especies WHERE ESPECIE = :especie');
 	$statement->execute(array(':especie'=>$especie));
 	//ELIMINO LAS RAZAS QUE CORRESPONDEN A ESA ESPECIE QUE ELIMINE
 	$statement2 = $conexion->prepare('DELETE FROM especies_raza WHERE TIPO = :especie');
 	$statement2->execute(array(':especie'=>$especie));

 	header('location:index_panel_general.php?especieEliminada');
 		
 }else{

	$statement = $conexion->prepare('SELECT * FROM especies');
	$statement->execute();
	$resultado = $statement->fetchAll();

 }


require'views/eliminar_especie.view.php';
 ?>