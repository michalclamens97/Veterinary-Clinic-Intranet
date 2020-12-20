<?php session_start();
require 'admin/config.php';
require 'functions.php';
comprobarSession();
//Llamo a mi funcion conexion para conectar con las base de datos
$conexion = conexion($bd_config);

if (!$conexion) {
	echo "Error al conectar con la base de datos";
}

//Verifico si los datos del formulario fueron enviados (si se le dio al submit)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
 $cedula = limpiarDatos($_POST['cedula']);
//Primero verifico si ya existe alguien con esa cedula
 	$statement = $conexion->prepare('SELECT * FROM cliente WHERE CEDULA = :cedula');
 	$statement->execute(array(':cedula'=>$cedula));
 	$resultado = $statement->fetchAll();
 	//ES DECIR SI NO EXISTE NADIE CON ESA CEDULA EN LA BD ENTONCES PROCEDO A REGISTRAR AL CLIENTE Y A SU MASCOTA
 	if (empty($resultado)) {

//Guardo todos los valores y en algunos uso la funcion limpiarDatos para evitar que me inyecten codigos o espacios
 $nombre = limpiarDatos(ucwords($_POST['nombre']));
 $apellido = limpiarDatos(ucwords($_POST['apellido']));
 $telefono = limpiarDatos($_POST['telefono']);
 $direccion = limpiarDatos(ucwords($_POST['direccion']));
 $nombre_mascota = limpiarDatos(ucwords($_POST['nombre_mascota']));
 $especie = $_POST['especie'];
 $raza = $_POST['raza'];
 $edad = limpiarDatos($_POST['edad']);
 $sexo = $_POST['sexo'];
 $peso = limpiarDatos($_POST['peso']);
 $esterilizado = limpiarDatos($_POST['esterilizacion']);


//Preparo y ejecuto la consulta de los datos del cliente
$statement = $conexion->prepare('INSERT INTO cliente (NOMBRE, APELLIDO, CEDULA, TELEFONO, DIRECCION) VALUES (:nombre,:apellido,:cedula,:telefono,:direccion)');
$statement->execute(array(

	':nombre' => $nombre,
	':apellido' => $apellido,
	':cedula' => $cedula,
	':telefono' => $telefono,
	':direccion' => $direccion

	));





//Preparo y ejecuto la consulta de los datos de la mascota
$statement = $conexion->prepare('INSERT INTO mascota (ID, NOMBRE, ESPECIE, RAZA, EDAD, SEXO, PESO, ESTERILIZADO, CEDULA_CLIENTE) VALUES (null, :nombre_mascota, :especie, :raza, :edad, :sexo, :peso, :esterilizado, :cedula_cliente)');
$statement->execute(array(

	':nombre_mascota' => $nombre_mascota,
	':especie' => $especie,
	':raza' => $raza,
	':edad' => $edad,
	':sexo' => $sexo,
	':peso' => $peso,
	':esterilizado' => $esterilizado,
	':cedula_cliente' => $cedula

	));
	
	header('Location: index.php?clienteFin');

}else{

		header('Location: formulario_insertar_cliente.php?error');

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}else{

	$statement = $conexion->prepare('SELECT * FROM especies');
	$statement->execute();
	$resultado = $statement->fetchAll();

}


require 'views/formulario_insertar_cliente.view.php';


 ?>