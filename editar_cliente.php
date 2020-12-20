<?php session_start();
require('admin/config.php');
require('functions.php');
comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "ERROR";
}

//Es decir si se mandaron los datos(si se le dio click al boton de actualizar) entonces actualizame los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST'){


		$cedula = limpiarDatos($_POST['cedula']); // Cedula Vieja que esta en la base de datos que necesitamos para saber a quien vamos a editar
		$telefono = limpiarDatos($_POST['telefono']);
		$direccion = limpiarDatos(ucwords($_POST['direccion']));
		$cedula_nueva = limpiarDatos($_POST['cedula_nueva']);
		$nombre = limpiarDatos(ucwords($_POST['nombre']));
		$apellido = limpiarDatos(ucwords($_POST['apellido']));

		$statement_verifica_cedula = $conexion->prepare('SELECT * FROM cliente WHERE CEDULA = :cedula');
 		$statement_verifica_cedula->execute(array(':cedula'=>$cedula_nueva));
 		$resultado_verifica_cedula = $statement_verifica_cedula->fetchAll();

 		//AQUI VERIFICO DOS COSAS, SI LA CEDULA NUEVA QUE SE INGRESO NO SE ENCUENTRA YA REGISTRADA EN LA BASE DE DATOS ENTONCES PROCEDO A INSERTAR, Y SI LA CEDULA
 		//VIEJA QUE ESTA EN  LA BASE DE DATOS ES IGUAL A LA CEDULA NUEVA (ES DECIR SI EL USUARIO DEJA LA MISMA CEDULA) ENTONCES TAMBIEN PROCEDO A INSERTAR YA QUE 
 		//SIGNIFICA ESTA EDITANDO OTROS DATOS QUE NO SON LA CEDULA
 		if (empty($resultado_verifica_cedula) or ($cedula == $cedula_nueva)) {

		$statement = $conexion->prepare("UPDATE cliente SET NOMBRE = :nombre, APELLIDO = :apellido, TELEFONO = :telefono, DIRECCION = :direccion, CEDULA = :ci WHERE CEDULA = :cedula");
		$statement->execute(array(
			':nombre' => $nombre,
			':apellido' => $apellido,
			':telefono' => $telefono,
			':direccion' => $direccion,
			':cedula' => $cedula,
			':ci' => $cedula_nueva

			));
		
		header('Location: mostrar_clientes_dataTable.php?clienteModificado');
	}else{
		header('Location: mostrar_clientes_dataTable.php?clienteError');

	}

	}else{//Sino se mandaron los datos, es decir si no se le ha dado click al boton de modificar entonces obtengo la ci que mande desde mostrar_cliente.php y obtengo todos los datos del cliente con esa ci, estos datos son los que muestro en los inputs de editar_cliente.view.php. Es decir siempre va a entrar primero en este else y luego es que entra en el if. (SIEMPRE QUE SE VAYA A EDITAR ALGO HAY QUE HACERLO DE ESTA FORMA CON ESTE IF Y ELSE)
		$cedula = $_GET['ci'];
		$statement = $conexion->prepare("SELECT * FROM cliente WHERE CEDULA = :ci");
		$statement->execute(array(':ci'=>$cedula));
		$resultado = $statement->fetchAll();
	}



require('views/editar_cliente.view.php');

 ?>