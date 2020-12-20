<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();
comprobarUsuario();

$conexion = conexion($bd_config);
if (!$conexion) {
	
	echo "ERROR";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$informe = limpiarDatos($_POST['informe']);
$cedula = limpiarDatos($_POST['cedula']);
$id_mascota = limpiarDatos($_POST['id_mascota']);
$nombre_mascota = limpiarDatos($_POST['nombre_mascota']);
$motivo = limpiarDatos($_POST['motivo']);
$procedimientos = limpiarDatos($_POST['procedimientos']);
$observaciones = limpiarDatos($_POST['observaciones']);
$fecha_cita = limpiarDatos($_POST['fecha_cita']);
$proxima_cita = limpiarDatos($_POST['proxima_cita']);
$precio = limpiarDatos($_POST['precio']);
$medicamentos = $_POST['medicamentos'];


$statementCliente = $conexion->prepare('SELECT * from cliente WHERE CEDULA = :ci');
$statementCliente->execute(array(':ci'=>$cedula));
$resultadoCliente = $statementCliente->fetchAll();
foreach ($resultadoCliente as $dato) {
	
	$nombre_cliente = $dato['NOMBRE'];
	$apellido_cliente = $dato['APELLIDO'];
}
///////////////////////////////////////////////////////////
$statementMascota = $conexion->prepare('SELECT * FROM mascota WHERE ID = :id');
$statementMascota->execute(array(':id'=>$id_mascota));
$resultadoMascota = $statementMascota->fetchAll();
foreach ($resultadoMascota as $valor) {
	
	$raza = $valor['RAZA'];
	$especie = $valor['ESPECIE'];
	$edad = $valor['EDAD'];
}


////////////////////////////////////////////////////////////
$statement = $conexion->prepare('INSERT INTO informe_medico (CEDULA_CLIENTE, ID_MASCOTA, NOMBRE_MASCOTA, MOTIVO, PROCEDIMIENTOS, OBSERVACIONES, FECHA_CITA, PROXIMA_CITA, PRECIO, INFORME, MEDICAMENTOS) VALUES (:ci,:id,:nombre,:motivo,:procedimientos,:observaciones,:fecha_cita,:proxima_cita,:precio,:informe,:medicamentos)');

$statement->execute(array(

	':ci' =>  $cedula,
	':id' =>  $id_mascota,
	':nombre' =>  $nombre_mascota,
	':motivo' =>  $motivo,
	':procedimientos' =>  $procedimientos,
	':observaciones' =>  $observaciones,
	':fecha_cita' => $fecha_cita,
	':proxima_cita' =>  $proxima_cita,
	':precio' =>  $precio,
	':informe' =>  $informe,
	':medicamentos' => $medicamentos

	));

echo "
<script>
window.open('generar_informe_medico.php?motivo=$motivo&nombre_mascota=$nombre_mascota&id_mascota=$id_mascota&cedula_cliente=$cedula&procedimientos=$procedimientos&observaciones=$observaciones&proxima_cita=$proxima_cita&fecha_cita=$fecha_cita&precio=$precio&informe=$informe&nombre_cliente=$nombre_cliente&apellido_cliente=$apellido_cliente&raza=$raza&especie=$especie&edad=$edad&medicamentos=$medicamentos','_blank');
location.href= 'index.php?informeFin';
</script>";

}else{
$cedula = limpiarDatos($_GET['cedula']);
$id_mascota = limpiarDatos($_GET['id_mascota']);
$nombre_mascota = limpiarDatos($_GET['nombre_mascota']);
$motivo = limpiarDatos($_GET['motivo']);
$procedimientos = limpiarDatos($_GET['procedimientos']);
$observaciones = limpiarDatos($_GET['observaciones']);
$fecha_cita = limpiarDatos($_GET['fecha_cita']);
$proxima_cita = limpiarDatos($_GET['proxima_cita']);
$precio = limpiarDatos($_GET['precio']);
$medicamentos = $_GET['medicamentos'];
$tratamiento = $_GET['tratamiento'];
$tratamiento = str_replace(".", "\n", $tratamiento);

}


require'views/informe_medico.view.php';
 ?>