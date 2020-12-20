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

	$medicamento = limpiarDatos($_POST['medicamento']);
	$precio = limpiarDatos($_POST['precio']);


	$statement = $conexion->prepare('UPDATE medicamentos SET PRECIO = :precio WHERE NOMBRE = :nombre');
	$statement->execute(array(

		':precio' => $precio,
		':nombre' => $medicamento

		));
		
		header('Location: mostrar_medicamentos_dataTable.php?modificado');
			

	
	}else{

		$medicamento = $_GET['medicamento'];
		$statement = $conexion->prepare('SELECT * FROM medicamentos WHERE NOMBRE = :medicamento');
		$statement->execute(array(':medicamento'=>$medicamento));
		$resultado = $statement->fetchAll();
		
	}


require'views/editar_medicamento.view.php';
 ?>