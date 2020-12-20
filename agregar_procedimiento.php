<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$procedimiento = limpiarDatos(ucfirst($_POST['procedimiento']));
 	$precio = $_POST['precio'];
 	//VERIFICO SI YA EXISTE ESE MOTIVO EN LA BD
 	$statement = $conexion->prepare('SELECT * FROM procedimientos_consulta WHERE PROCEDIMIENTO = :procedimiento');
 	$statement->execute(array(':procedimiento'=>$procedimiento));
 	$resultado = $statement->fetchAll();

 		if (empty($resultado)) {
 			
 			$statement = $conexion->prepare('INSERT INTO procedimientos_consulta (PROCEDIMIENTO,PRECIO) VALUES (:procedimiento,:precio)');
 			$statement->execute(array(':procedimiento'=>$procedimiento,':precio'=>$precio));
 			header('location:index_panel_general.php?registradoProcedimiento');
 		}else{
 			header('location:agregar_procedimiento.php?error');
 		}


 }else{

	$statement = $conexion->prepare('SELECT * FROM procedimientos_consulta');
	$statement->execute();
	$resultado = $statement->fetchAll();
 }


require'views/agregar_procedimiento.view.php';
 ?>