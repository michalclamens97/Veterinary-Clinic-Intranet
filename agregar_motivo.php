<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$motivo = limpiarDatos(ucfirst($_POST['motivo']));
 	//VERIFICO SI YA EXISTE ESE MOTIVO EN LA BD
 	$statement = $conexion->prepare('SELECT * FROM motivo_consulta WHERE MOTIVO = :motivo');
 	$statement->execute(array(':motivo'=>$motivo));
 	$resultado = $statement->fetchAll();

 		if (empty($resultado)) {
 			
 			$statement = $conexion->prepare('INSERT INTO motivo_consulta (MOTIVO) VALUES (:motivo)');
 			$statement->execute(array(':motivo'=>$motivo));
 			header('location:index_panel_general.php?registradoMotivo');
 		}else{
 			header('location:agregar_motivo.php?error');
 		}


 }else{

	$statement = $conexion->prepare('SELECT * FROM motivo_consulta');
	$statement->execute();
	$resultado = $statement->fetchAll();
 }


require'views/agregar_motivo.view.php';
 ?>