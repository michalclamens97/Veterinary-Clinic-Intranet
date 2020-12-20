<?php session_start();
require'admin/config.php';
require'functions.php';
comprobarSession();
comprobarUsuario();
$conexion = conexion($bd_config);

if (!$conexion) {
	
	echo "ERROR";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


$productos = limpiarDatos($_POST['productos']); 
$fecha_desparasitacion = limpiarDatos($_POST['f_desparasitacion']);

//CAPTURO EL ID DE LA MASCOTA Y HAGO UNA CONSULTA PARA OBTENER LOS OTROS DATOS DE LA MASCOTA Y UNA CONSULTA PARA LOS DEL CLIENTE
$id_mascota = limpiarDatos($_POST['mascota']);
$statement = $conexion->prepare('SELECT * FROM mascota WHERE ID = :id');
$statement->execute(array(':id' => $id_mascota));
$resultadoMascota = $statement->FetchAll();

foreach ($resultadoMascota as $dato ) {
	
	$nombre_mascota =  $dato['NOMBRE'];
	$raza_mascota = $dato['RAZA'];
	$especie_mascota = $dato['ESPECIE'];
	$sexo_mascota = $dato['SEXO'];
	$edad_mascota = $dato['EDAD'];
	$cedula_cliente = $dato['CEDULA_CLIENTE'];
}

$statement = $conexion->prepare('SELECT * FROM cliente WHERE CEDULA = :ci');
$statement->execute(array(':ci'=>$cedula_cliente));
$resultadoCliente = $statement->FetchAll();
foreach ($resultadoCliente as $dato ) {
	$nombre_cliente = $dato['NOMBRE'];
	$apellido_cliente = $dato['APELLIDO'];
	$direccion_cliente = $dato['DIRECCION'];
	$telefono = $dato['TELEFONO'];
}


/////////////////////////////////////////////////////////////
$statement = $conexion->prepare('INSERT INTO desparasitacion (CEDULA, NOMBRE, ID_MASCOTA, MASCOTA, RAZA, ESPECIE, PRODUCTOS, FECHA_CONSTANCIA) VALUES (:ci, :nombre, :id, :mascota, :raza, :especie, :productos, :fecha_constancia)');
$statement->execute(array(

	':ci' => $cedula_cliente,
	':nombre' => $nombre_cliente .' '. $apellido_cliente,
	':id' => $id_mascota,
	':mascota' => $nombre_mascota,
	':raza' => $raza_mascota,
	':especie' => $especie_mascota,
	':productos' => $productos,
	':fecha_constancia' => $fecha_desparasitacion


	));
//Primero mando que se abra en otra pestana el archivo donde creo el pdf y le paso por la url todos los datos que voy a necesitar, luego redirecciono al index
echo "
<script>
window.open('constancia_desparasitacion.php?nombre=$nombre_cliente&apellido=$apellido_cliente&cedula=$cedula_cliente&direccion=$direccion_cliente&telefono=$telefono&nombre_mascota=$nombre_mascota&raza=$raza_mascota&especie=$especie_mascota&sexo=$sexo_mascota&fecha_d=$fecha_desparasitacion&productos=$productos&edad=$edad_mascota','_blank');

location.href= 'index.php?parasitosFin';
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
/////////////////////////////////////////////////////////////////////////////
$statementProductos = $conexion->prepare('SELECT * FROM productos');
$statementProductos->execute();
$resultadoProducto = $statementProductos->fetchAll();


}


require'views/formulario_desparasitacion.views.php';
 ?>

