<?php 
require 'admin/config.php';
require 'functions.php';

$conexion = conexion($bd_config);

if (!$conexion) {
	echo "Error al conectar con la base de datos";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$cedula = limpiarDatos($_POST['cedula']);

	$statement = $conexion->prepare('SELECT CEDULA FROM cliente WHERE CEDULA = :cedula');
	$statement->execute(array(':cedula'=>$cedula));
	$resultado = $statement->fetch();

	if (!$resultado) {
		
		 echo "<script>
              alert('No hay un cliente registrado con esa cedula');
              window.location.href='buscar_cliente_vacunacion.php';
          </script>";
	}else{
		//Si hay un cliente con esa cedula en la bd entonces mando a la pagina de formulario consulta pasandole la cedula por get
		header('Location:formulario_vacunacion.php?cedula='.$resultado[0]);

	}

}

require 'views/buscar_cliente.view.php';

?>