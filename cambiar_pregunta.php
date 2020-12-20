<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();
//comprobarUsuario();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 
 	$pregunta = $_POST['pregunta'];
 	$respuesta = filter_var(strtolower($_POST['respuesta']), FILTER_SANITIZE_STRING);
 	$usuario = $_SESSION['usuario'];
 	
 	$statement = $conexion->prepare('UPDATE login SET PREGUNTA = :pregunta, RESPUESTA = :respuesta WHERE USUARIO =:user');
 	$statement->execute(array(
 		':pregunta' => $pregunta,
 		':respuesta' => $respuesta,
 		':user' => $usuario

 		));
 			//REVISO SI ES EL ADMIN O EL USER NORMAL
 			if ($_SESSION['usuario'] == 'admin'){
 			header('location:index_administracion.php?cambiar');
 			}else{
 			header('location:index_administracion_usuario.php?cambiar');
 			}
 }else{
 	//Obtengo la pregunta que tiene ya puesta el usuario de la sesion para poder mostrarla y que sepa cual tiene puesta 
 	$usuario = $_SESSION['usuario'];
 	$statement = $conexion->prepare('SELECT PREGUNTA FROM login WHERE USUARIO = :user');
 	$statement->execute(array(':user'=>$usuario));
 	$resultado = $statement->fetch();
 	$pregunta = $resultado[0];
 }
 


require'views/cambiar_pregunta.view.php';
 ?>