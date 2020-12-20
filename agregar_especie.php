<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$especie = limpiarDatos(strtolower($_POST['especie']));
 	//VERIFICO SI YA EXISTE ESA ESPECIE EN LA BD
 	$statement = $conexion->prepare('SELECT * FROM especies WHERE ESPECIE = :especie');
 	$statement->execute(array(':especie'=>$especie));
 	$resultado = $statement->fetchAll();

 		if (empty($resultado)) {
 			
 			$statement = $conexion->prepare('INSERT INTO especies (ESPECIE) VALUES (:especie)');
 			$statement->execute(array(':especie'=>$especie));
 			header('location:index_panel_general.php?registrado');
 		}else{
 			header('location:agregar_especie.php?error');
 		}


 }else{

	$statement = $conexion->prepare('SELECT * FROM especies');
	$statement->execute();
	$resultado = $statement->fetchAll();
 }


require'views/agregar_especie.view.php';
 ?>