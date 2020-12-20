<?php
require'admin/config.php';
require'functions.php';

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}


 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	//Obtenemos el usuario, usamos strtolower para convertir el texto en misnuscula ya que en nuestra bd el usuario esta en miniscula y tambien usamos filter_var para limpiar el texto y evitar que me inyecten codigo html
 	$usuario = filter_var(strtolower($_POST['usuario']), FILTER_SANITIZE_STRING);
 	
 	//Selecciono la pregunta dependiendo del usuario que se ingreso
 	$statement = $conexion->prepare('SELECT PREGUNTA FROM login WHERE USUARIO = :usuario ');

 
 	$statement->execute(array(':usuario'=>$usuario));

	//Como solo es un dato el que me obtengo uso fetch
 	$resultado = $statement->fetch();
 	//Guardo ese dato (la pregunta) en una variable
 	$pregunta = $resultado[0];

 	//Si se obtuvo la pregunta entonces mando a recuperar.php y le paso la pregunta y el usuario que quiere recuperar su pass
 	if (!empty($resultado)){
 		header('Location: recuperar.php?pregunta='.$pregunta.'&user='.$usuario);
 	}else{
 		//Es decir si no se encontro a nadie en la bd con esos datos me redirecciona al login pero me agrega en la url la variable error, al hacer esto puedo revisar en login.view.php si se produjo un error y mostrar un mensaje. Esto lo hago verificando si la url esta setiada con la variable error
		 header('Location: login_recuperar.php?error');
 	}

 ////////////////////////CODIGO SI LE DA EN RECUPERAR CONTRASENA//////////////////////////////////////////////////

 }







require'views/login_recuperar.view.php';
?>