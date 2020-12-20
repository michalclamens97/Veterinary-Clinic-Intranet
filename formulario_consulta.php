<?php session_start();
require('admin/config.php');
require('functions.php');
comprobarSession();
comprobarUsuario();
$conexion = conexion($bd_config);

if (!$conexion) {
	echo "Error al conectar con la base de datos";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

//obtengo el id de la mascota que se selecciono en el select
$id_mascota = limpiarDatos($_POST['mascota']);

///////////////////////////////////////////////////////
//Consulta a la base de datos para obtener el nombre y otros datos de la mascota
$statement = $conexion->prepare('SELECT * FROM mascota WHERE ID = :id');
$statement->execute(array(':id'=>$id_mascota));
$resultado_mascota = $statement->fetchAll();
foreach ($resultado_mascota as $valor) {
	$nombre = $valor['NOMBRE'];
	$raza = $valor['RAZA'];
	$especie = $valor['ESPECIE'];
}
////////////////////////////////////////////////////////
//Consulta a la tabla mascota para obtener la cedula del cliente cuya mascota se esta haciendo la consulta
$statement_Cedula = $conexion->prepare('SELECT CEDULA_CLIENTE FROM mascota WHERE ID = :id');
$statement_Cedula->execute(array(':id'=>$id_mascota));
$resultado_cedula_cliente = $statement_Cedula->fetch();
$cedula_cliente = $resultado_cedula_cliente[0];

///////////////////////////////////////////////////////
//Obtengo los demas valores del formulario
$nombre_mascota = $nombre;
$motivo = limpiarDatos(ucfirst($_POST['motivo']));
$procedimientos = limpiarDatos($_POST['procedimientos']);
$medicamentos = limpiarDatos($_POST['medicamentos']);
$observaciones = limpiarDatos($_POST['observaciones']);
$fecha_cita = limpiarDatos($_POST['fecha_cita']);
$proxima_cita = $_POST['proxima_cita'];
$precio = limpiarDatos($_POST['precio']);
$tratamiento = limpiarDatos($_POST['tratamiento']);

//Veo si la variable observaciones est vacia, si este es el caso entonces le agrego el texto sin observaciones
if ($observaciones == ""){
	$observaciones = "Sin Observaciones";
}


//consulta a la base de datos para insertar todos los datos de la consulta
$statement = $conexion->prepare('INSERT INTO consulta (CEDULA_CLIENTE, ID_MASCOTA, NOMBRE_MASCOTA, MOTIVO, PROCEDIMIENTOS, MEDICAMENTOS, OBSERVACIONES, FECHA_CITA,PROXIMA_CITA, PRECIO, TRATAMIENTO) VALUES (:cedula, :id, :nombre, :motivo, :procedimientos, :medicamentos, :observaciones,:fecha_cita, :proxima, :precio, :tratamiento) ');
$statement->execute(array(
	':cedula' => $cedula_cliente,
	':id' => $id_mascota,
	':nombre' => $nombre_mascota,
	':motivo' => $motivo,
	':procedimientos' => $procedimientos,
	':medicamentos' => $medicamentos,
	':observaciones' => $observaciones,
	':fecha_cita' => $fecha_cita,
	'proxima' => $proxima_cita,
	':precio' => $precio,
	':tratamiento' => $tratamiento

	));

//Consulta a la base de datos para obtner el nombre y apellido del cliente y poder mandarlos al recipe medico
$statement_nombre_apellido = $conexion->prepare('SELECT * FROM cliente WHERE CEDULA = :ci');
$statement_nombre_apellido->execute(array(':ci'=>$cedula_cliente));
$resultado_nombre_apellido = $statement_nombre_apellido->fetchAll();
foreach ($resultado_nombre_apellido as $valor ) {
	$nombre = $valor['NOMBRE'];
	$apellido = $valor['APELLIDO'];
}

$tratamientoNuevo =  preg_replace("~[\r\n]~", "/",$tratamiento);

echo "
<script>
location.href= 'index.php?consultaFin';
window.open('recipe_medico.php?tratamiento=$tratamientoNuevo&medicamentos=$medicamentos&fecha=$fecha_cita&nombre_mascota=$nombre_mascota&id_mascota=$id_mascota&cedula_cliente=$cedula_cliente&nombre_cliente=$nombre&apellido_cliente=$apellido&raza=$raza&especie=$especie','_blank');
</script>";

}else{

$cedula = limpiarDatos($_GET['cedula']);
///////////////////////////////////////////////////////////////////////////////
# Selecciono todo los datos del cliente con la cedula que se ingreso, los resultados los guardo en resultadoCliente
$statement = $conexion->prepare('SELECT * FROM cliente WHERE CEDULA = :cedula');
$statement->execute(array(':cedula'=>$cedula));
$resultadoCliente = $statement->fetchAll();
//print_r($resultadoCliente);

///////////////////////////////////////////////////////////////////////////////
# Selecciono todas las mascotas que tenga ese cliente, los resultados los guardo en resultadoMascota (estas mascotas las muestro en un select)
$statement = $conexion->prepare('SELECT * FROM mascota WHERE CEDULA_CLIENTE = :cedula');
$statement->execute(array(':cedula'=>$cedula));
$resultadoMascota = $statement->fetchAll();
//print_r($resultadoMascota);

//Obtengo los medicamentos que hay en la base de datos hasta ahora
$statementMedicamentos = $conexion->prepare('SELECT * FROM medicamentos');
$statementMedicamentos->execute();
$resultadoMedicamentos = $statementMedicamentos->FetchAll();


//Obtengo los motivos que hay en la base de datos hasta ahora
$statementMotivo = $conexion->prepare('SELECT * FROM motivo_consulta');
$statementMotivo->execute();
$resultadoMotivo = $statementMotivo->fetchAll();

//Obtengo los procedimientos que hay en la base de datos hasta ahora
$statementProcedimiento = $conexion->prepare('SELECT * FROM procedimientos_consulta');
$statementProcedimiento->execute();
$resultadoProcedimiento = $statementProcedimiento->fetchAll();

}

require('views/formulario_consulta.view.php');
 ?>