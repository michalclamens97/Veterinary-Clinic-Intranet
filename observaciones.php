<?php session_start();
require'admin/config.php';
require'functions.php';
comprobarSession();
$conexion = conexion($bd_config);
if (!$conexion) {
	echo "ERROR";
}
//Obtengo los datos que pase por ajax (id de la mascota y fecha de la cita)
$datos = $_POST['id'];

//Separo el id y la fecha y los guardo por separados (ya yo se que entre el id y la fecha hay un / de por medio)
list($id,$fecha,$proxima,$precio,$motivo,$mascota,$procedimientos) = explode("/",$datos); 

$statement= $conexion->prepare('SELECT OBSERVACIONES FROM consulta WHERE ID_MASCOTA = :id AND FECHA_CITA = :fecha AND PROXIMA_CITA =:proxima AND PRECIO = :precio AND MOTIVO = :motivo AND NOMBRE_MASCOTA = :mascota AND PROCEDIMIENTOS = :procedimientos');
$statement->execute(array(

	':id' => $id,
	':fecha' => $fecha,
	':proxima' => $proxima,
	':precio' => $precio,
	':motivo' => $motivo,
	':mascota' => $mascota,
	':procedimientos' => $procedimientos
	));
$resultado = $statement->fetch();

$observaciones = $resultado[0];
//PARA QUE DESPUES DE 65 CARACTERES ME AGREGUE UN SALTO DE LINEA Y DE ESTA MANERA EL TEXTO NO SE ME SALGA DEL MODAL
$observaciones = wordwrap($observaciones, 64, "\n", true);

echo "$observaciones";
 ?>