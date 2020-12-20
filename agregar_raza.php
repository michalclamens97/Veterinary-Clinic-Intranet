<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	$especie = limpiarDatos(strtolower($_POST['especie']));
 	$raza = limpiarDatos(ucwords($_POST['raza']));
 	//VERIFICO SI YA EXISTE ESA RAZA EN LA BD
 	$statement = $conexion->prepare('SELECT * FROM especies_raza WHERE TIPO = :especie AND RAZA = :raza');
 	$statement->execute(array(':especie'=>$especie,':raza'=>$raza));
 	$resultado = $statement->fetchAll();

 		//SI NO ENCONTRO A ESA RAZA EN LA BD ENTONCES PROCEDO A REGISTRAR ESA NUEVA RAZA
 		if (empty($resultado)) {
 			
 			$statement = $conexion->prepare('INSERT INTO especies_raza (TIPO,RAZA) VALUES (:especie,:raza)');
 			$statement->execute(array(':especie'=>$especie,':raza'=>$raza));
 			header('location:index_panel_general.php?registradoRaza');
 		}else{
 			header('location:agregar_raza.php?errorRaza');
 		}


 }else{

	$statement = $conexion->prepare('SELECT * FROM especies');
	$statement->execute();
	$resultado = $statement->fetchAll();
 }


require'views/agregar_raza.view.php';
 ?>