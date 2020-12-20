<?php session_start();
require 'admin/config.php';
require'functions.php';
comprobarSession();
$conexion = conexion($bd_config);

if (!$conexion) {
	echo "Error al conectar con la base de datos";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//ucfirst es para colocar la primera letra en mayuscula
$producto = limpiarDatos(ucfirst($_POST['producto']));
//REVISO PRIMERO QUE NO ESTE YA ESE PRODUCTO EN LA BD
$statement = $conexion->prepare('SELECT * FROM productos WHERE PRODUCTO = :producto');
$statement->execute(array(':producto'=>$producto));
$resultado = $statement->fetchAll();

//SI ESE PRODUCTO NO ESTA REGISTRADO YA EN LA BD ENTONCES PROCEDO A REGISTRARLO
if (empty($resultado)) {
	$lote = limpiarDatos($_POST['lote']);
	$elaboracion = limpiarDatos($_POST['elaboracion']);
	$vencimiento = limpiarDatos($_POST['vencimiento']);

	$statement = $conexion->prepare('INSERT INTO productos (PRODUCTO, LOTE, ELABORACION, VENCIMIENTO) VALUES (:producto, :lote, :elaboracion, :vencimiento)');
	$statement->execute(array(
	
		':producto' => $producto,
		'lote' => $lote,
		'elaboracion' => $elaboracion,
		'vencimiento' => $vencimiento
		));

	header('Location:index_panel_productos.php?finalizado');

}else{
	header('Location:insertar_productos.php?error');
}




}

require'views/insertar_productos.view.php';
 ?>