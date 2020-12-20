<?php session_start();
require('admin/config.php');
require('functions.php');
comprobarSession();
$conexion = conexion($bd_config);
if (!$conexion) {
	echo "ERROR";
}

$medicamento = $_GET['medicamento'];
$statement = $conexion->prepare('DELETE FROM medicamentos WHERE NOMBRE = :medicamento');
$statement->execute(array(

	':medicamento' => $medicamento

	));
 
 header('Location: mostrar_medicamentos_dataTable.php?eliminado');

 ?>