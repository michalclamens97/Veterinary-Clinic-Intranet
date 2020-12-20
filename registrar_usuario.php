<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();
comprobarUsuario();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 
 	
 	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
 	//VERIFICO QUE NO HAYA YA UN USUARIO CON ESE MISMO NOMBRE EN LA BD
 	$statement = $conexion->prepare('SELECT * FROM login WHERE USUARIO = :user');
 	$statement->execute(array(':user'=>$usuario));
 	$resultado = $statement->fetchAll();
 	//ES DECIR SI NO EXISTE NADIE CON ESE NOMBRE EN LA BD ENTONCES PROCEDO A REGISTRAR AL USUARIO
 	if (empty($resultado)) {
 		 	$pass = limpiarDatos($_POST['pass']);
 			$repass = limpiarDatos($_POST['repass']);
 			$pregunta = limpiarDatos($_POST['pregunta']);
 			$respuesta = filter_var(strtolower($_POST['respuesta']), FILTER_SANITIZE_STRING);

 			$statement = $conexion->prepare('INSERT INTO login (ID, USUARIO, PASS, PREGUNTA, RESPUESTA) VALUES (null,:user,:pass,:pregunta,:respuesta)');
 			$statement->execute(array(
 				':user' => $usuario,
 				':pass' => $pass,
 				':pregunta' => $pregunta,
 				':respuesta' => $respuesta

 				));

 				header('location:index_administracion.php?registrado');
 	}else{
 		header('location:registrar_usuario.php?error');

 	}



 
 }
 



require'views/registrar_usuario.view.php';
 ?>