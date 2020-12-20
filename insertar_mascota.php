<?php session_start();
require 'admin/config.php';
require 'functions.php';

comprobarSession();

$conexion = conexion($bd_config);

if (!$conexion) {
	echo "Error al conectar con la base de datos";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


 $nombre_mascota = limpiarDatos(ucwords($_POST['nombre_mascota']));
 $cedula_cliente = limpiarDatos($_POST['cedula']);
 $especie = $_POST['especie'];
 $raza = $_POST['raza'];
 $edad = limpiarDatos($_POST['edad']);
 $sexo = $_POST['sexo'];
 $peso = limpiarDatos($_POST['peso']);
 $esterilizado = limpiarDatos($_POST['esterilizacion']);



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$statement = $conexion->prepare('INSERT INTO mascota (ID, NOMBRE, ESPECIE, RAZA, EDAD, SEXO, PESO, ESTERILIZADO, CEDULA_CLIENTE) VALUES (null, :nombre_mascota, :especie, :raza, :edad, :sexo, :peso, :esterilizado, :cedula_cliente)');
$statement->execute(array(

	':nombre_mascota' => $nombre_mascota,
	':especie' => $especie,
	':raza' => $raza,
	':edad' => $edad,
	':sexo' => $sexo,
	':peso' => $peso,
	':esterilizado' => $esterilizado,
	':cedula_cliente' => $cedula_cliente

	));



header('Location: mostrar_clientes_consultas_dataTable.php?mascotaFin');
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{

	$statement = $conexion->prepare('SELECT * FROM especies');
	$statement->execute();
	$resultado = $statement->fetchAll();

}




require 'views/insertar_mascota.view.php';





 ?>