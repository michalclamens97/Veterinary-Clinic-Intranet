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


///////////////////////////////////////////////////////////
//CAPTURO LOS DATOS DE LA VACUNA
$fecha_aplicacion = $_POST['f_aplicacion'];
$fecha_proxima = $_POST['f_proxima'];
$cantidad = limpiarDatos($_POST['cantidad']);
//Es decir si esta setiada el arreglo vacunas lo guardo sino es decir si hay una opcion que no se selecciono entonces le asigno el valor de nulo a esa posicion (esto hay que hacerlo ya que obviamente siempre va a quedar vacunas sin seleccionar entonces esas vacunas tengo que ponerles como valor en el arreglo null)
$vacunas = isset($_POST['vacunas']) ? $_POST['vacunas'] : null;

	$arrayVacunas = null;
	//Cuento cuantos elementos tiene mi arreglo vacunas (las vacunas las cree en el form como un arreglo, por lo que al seleccionar una opcion de los checkbox se agrega un elemento al arreglo, si se selecciona otro se agrega un segundo elemento al arreglo y asi con los demas)
	$num_array = count($vacunas);
	$contador = 0;
	//Es decir si mi arreglo no esta vacio entonces lo recorro y voy concatenando sus valores en mi arreglo de arrayInteres
	if ($num_array>0) {
		foreach ($vacunas as $key => $value) {
			//Si contador es diferente al ultimo elemento de mi arreglo, es decir todavia no ha llegado al final (ya sabemos que num_array es donde guarde el resultado de la funcion count, le resto 1 ya que la funcion me regresa los numeros de elemento del arreglo pero sin contar el 0)
			if ($contador != $num_array-1){
			//Concateno el valor en mi arrayIntereses
			$arrayVacunas .= $value.'/';
			//Incremento el contador
			$contador++;
			} else { //Si ya estoy en el ultimo elemento de mi arreglo simplemente lo concateno y me salgo del ciclo
			$arrayVacunas .= $value;
			}
		}
	}

	print_r($arrayVacunas);
///////////////////////////////////////////////////////////
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
}

//INSERTO LOS DATOS EN LA TABLA VACUNACION
$statement = $conexion->prepare('INSERT INTO vacunacion (CEDULA_CLIENTE,ID_MASCOTA,NOMBRE_MASCOTA,FECHA_APLICACION,FECHA_PROXIMA,ITEM,CANTIDAD) VALUES (:ci,:id,:nombre,:f_a,:f_p,:item,:cantidad)');
$statement->execute(array(
	':ci' => $cedula_cliente,
	':id' => $id_mascota,
	':nombre' => $nombre_mascota,
	'f_a' => $fecha_aplicacion,
	':f_p' => $fecha_proxima,
	':item' => $arrayVacunas,
	':cantidad' => $cantidad
	));

//Primero mando que se abra en otra pestana el archivo donde creo el pdf y le paso por la url todos los datos que voy a necesitar, luego redirecciono al index
echo "
<script>
window.open('certificado_vacunacion.php?nombre=$nombre_cliente&apellido=$apellido_cliente&cedula=$cedula_cliente&direccion=$direccion_cliente&nombre_mascota=$nombre_mascota&raza=$raza_mascota&especie=$especie_mascota&sexo=$sexo_mascota&fecha_a=$fecha_aplicacion&fecha_p=$fecha_proxima&item=$arrayVacunas&cantidad=$cantidad&edad=$edad_mascota','_blank');
location.href= 'index.php?vacunacionFin';
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




}


require'views/formulario_vacunacion.views.php';
 ?>

