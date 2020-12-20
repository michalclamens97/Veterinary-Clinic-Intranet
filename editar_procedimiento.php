<?php session_start();
require'admin/config.php';
require'functions.php';
comprobarSession();
$conexion = conexion($bd_config);
if (!$conexion) {
	echo "ERROR";
}

//Es decir si se mandaron los datos(si se le dio click al boton de actualizar) entonces actualizame los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$procedimiento = limpiarDatos($_POST['procedimiento']);
	$precio = limpiarDatos($_POST['precio']);
	

	$statement = $conexion->prepare('UPDATE procedimientos_consulta SET PRECIO = :precio WHERE PROCEDIMIENTO = :procedimiento');
	$statement->execute(array(

		':precio' => $precio,
		':procedimiento' => $procedimiento

		));
		//Mando la variable modificado para poder saber que ya se edito el producto y mostrar una notificacion de exito en mostrar_productos_dataTable.php
		header('Location: mostrar_procedimientos_dataTable.php?modificado');
			

	
	}else{

		$procedimiento = $_GET['procedimiento'];
		$statement = $conexion->prepare('SELECT * FROM procedimientos_consulta WHERE PROCEDIMIENTO = :procedimiento');
		$statement->execute(array(':procedimiento'=>$procedimiento));
		$resultado = $statement->fetchAll();
		
	}


require'views/editar_procedimiento.view.php';
 ?>