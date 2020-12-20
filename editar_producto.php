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

	$producto = limpiarDatos($_POST['producto']);
	$lote = limpiarDatos($_POST['lote']);
	$elaboracion = limpiarDatos($_POST['elaboracion']);
	$vencimiento = limpiarDatos($_POST['vencimiento']);

	$statement = $conexion->prepare('UPDATE productos SET LOTE = :lote, ELABORACION = :elaboracion, VENCIMIENTO = :vencimiento WHERE PRODUCTO = :producto');
	$statement->execute(array(

		':lote' => $lote,
		':elaboracion' => $elaboracion,
		':vencimiento' => $vencimiento,
		':producto' => $producto

		));
		//Mando la variable modificado para poder saber que ya se edito el producto y mostrar una notificacion de exito en mostrar_productos_dataTable.php
		header('Location: mostrar_productos_dataTable.php?modificado');
			

	
	}else{

		$producto = $_GET['producto'];
		$statement = $conexion->prepare('SELECT * FROM productos WHERE PRODUCTO = :producto');
		$statement->execute(array(':producto'=>$producto));
		$resultado = $statement->fetchAll();
		
	}


require'views/editar_producto.view.php';
 ?>