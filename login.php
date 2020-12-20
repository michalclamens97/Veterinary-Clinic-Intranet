<?php
session_start();
require'admin/config.php';
require'functions.php';

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	//Obtenemos el usuario, usamos strtolower para convertir el texto en misnuscula ya que en nuestra bd el usuario esta en miniscula y tambien usamos filter_var para limpiar el texto y evitar que me inyecten codigo html
 	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
 	$password = $_POST['password'];
 	$errores = '';
 	
 	$statement = $conexion->prepare('SELECT * FROM login WHERE USUARIO = :usuario AND PASS = :password');

 
 	$statement->execute(array(':usuario'=>$usuario, ':password' => $password));

 	//Guardamos el resultado , usamos fecth ya que solo nos deberia traer un registro porque es un nombre de usuario diferente para cada persona. Si no hay nadie registrado con ese usuario y contrasena entonces fetch me delvuelve false
 	$resultado = $statement->fetchAll();

 	//Lo que digo es si resultado es diferente de vacio, es decir que si esa persona si esta registrada en la base de datos, entonces creo una sesion a la cual le voy a agregar como valor el usuario que esta ingresando a la pagina principal(es decir aqui es donde le agrego el valor a mi variable sesion, es decir aqui es donde le agrego el usuario que esta conectando a mi variable sesion), luego mando a ese usuario a dicha pagina principal donde esta el contenido(pongo index.php ya que en esa pagina es en donde se revisa si la varible session esta setiada para mandar al usuario a la pagina con el contenido principal)
 	if (!empty($resultado)){

 		if ($usuario == "admin"){
 		$_SESSION['usuario'] = $usuario;
 		header('Location: index.php');
 		}else{
 			$_SESSION['usuario'] = $usuario;
 			header('Location: index_usuario.php');
 		}
 	}else{
 		//Es decir si no se encontro a nadie en la bd con esos datos me redirecciona al login pero me agrega en la url la variable error, al hacer esto puedo revisar en login.view.php si se produjo un error y mostrar un mensaje. Esto lo hago verificando si la url esta setiada con la variable error
		 header('Location: login.php?error');
 	}

 ////////////////////////CODIGO SI LE DA EN RECUPERAR CONTRASENA//////////////////////////////////////////////////

 }
 






require'views/login.view.php';
?>