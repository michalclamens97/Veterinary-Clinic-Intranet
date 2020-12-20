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
 	//Guardo en la variable usuario el usuario que esta en la sesion, de esta manera se a quien le voy a modificar las contrasena
 	$usuario = $_SESSION['usuario'];
 	$pass = limpiarDatos($_POST['password']);
 	//Cabe destacar que esta contrasena nueva y su confirmacion ya estan validadas con javascript, en formulario_contrasena.view.php
 	$pass_nueva = limpiarDatos($_POST['password_nueva']);
 	$pass_confirma = limpiarDatos($_POST['password_confirma']);

 	//Primero verifico si el usuario ingreso su contrasena vieja correctamente
 	$statement = $conexion->prepare('SELECT * FROM login WHERE USUARIO = :user AND PASS = :pass');
 	$statement->execute(array(':user'=>$usuario,':pass'=>$pass));
 	$resultado = $statement->fetch();

 	//Si el pass viejo que se ingreso si esta en la base de datos
 	if (!empty($resultado)) {
 		//Valido si el pass nuevo es igual a la confirmacion (esto es opcional ya que esto ya lo valide con js)
 		if ($password_nueva == $password_confirma) {
 			//Actualizo la contrasena
 			$statementActualiza = $conexion->prepare("UPDATE login SET PASS = :pass WHERE USUARIO = :user");
 			$statementActualiza->execute(
 			 array(
 				':pass'=>$pass_nueva,
 				':user'=>$usuario
 				));

 			//REVISO SI ES EL ADMIN O EL USER NORMAL
 			if ($_SESSION['usuario'] == "admin"){
 			header('location:index_administracion.php?contra');	
 			}else{
 				 header('location:index_administracion_usuario.php?contra');	

 			}
 		}
 	}else{
 		//Si el pass viejo que ingreso no es el correcto
 		header('location:formulario_contrasena.php?error');
 	}
 	

 	}


require'views/formulario_contrasena.view.php';
 ?>