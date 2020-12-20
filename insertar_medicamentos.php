<?php session_start();
require 'admin/config.php';
require'functions.php';
comprobarSession();

$conexion = conexion($bd_config);

if (!$conexion) {
	echo "Error al conectar con la base de datos";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$medicamento = limpiarDatos(ucfirst($_POST['medicamento']));
//REVISO QUE EL MEDICAMENTO NO ESTE YA REGISTRADO EN LA BD
$statement = $conexion->prepare('SELECT * FROM medicamentos WHERE NOMBRE = :nombre');
$statement->execute(array(':nombre'=>$medicamento));
$resultado = $statement->fetchAll();

//SI NO ESTA REGISTRADO PROCEDO A REGISTRARLO
if (empty($resultado)) {
	$precio = limpiarDatos($_POST['precio']);
	$statement = $conexion->prepare('INSERT INTO medicamentos (NOMBRE, PRECIO) VALUES (:nombre, :precio)');
	$statement->execute(array(

		':nombre' => $medicamento,
		'precio' => $precio
		));

	header('Location:index_panel_medicamentos.php?finalizado');
}else{
		header('Location:insertar_medicamentos.php?error');
}


}

require'views/insertar_medicamentos.view.php';
 ?>