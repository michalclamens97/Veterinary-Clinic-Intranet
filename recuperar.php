<?php
session_start();
require'admin/config.php';
require'functions.php';

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "error";
}

//Obtengo la pregunta de seguridad del usuario y el usuario que mande desde login_recuperar.php, esto es posible ya que en recuperar.view.php use REQUEST_URI y esto hace que no se pierdan las variables que tenia en la url al enviar el formulario
 $pregunta = $_GET['pregunta'];
 $user = $_GET['user'];
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
 	
 	//Obtenemos el usuario, usamos strtolower para convertir el texto en misnuscula ya que en nuestra bd el usuario esta en miniscula y tambien usamos filter_var para limpiar el texto y evitar que me inyecten codigo html
 	$respuesta = filter_var(strtolower($_POST['respuesta']), FILTER_SANITIZE_STRING);
 	$errores = '';
 	
 	//Seleccion el pass donde el usuario sea igual al usuario que quiere recuperar su pass y donde la respuesta se igual a la respuesta ingresada por ese usuario
 	$statement = $conexion->prepare('SELECT PASS FROM login WHERE USUARIO = :user AND RESPUESTA = :respuesta');

 	$statement->execute(array(':user'=>$user,':respuesta'=>$respuesta));

 	//Uso fetch ya que solo estoy obteniendo la pass del usuario
 	$resultado = $statement->fetch();
 	//Guardo esa pass en una variable
 	$pass = $resultado[0];


 	//Lo que digo es si resultado es diferente de vacio, es decir si se respondio bien a la pregunta de seguridad entonces redirecciono al login pero pasandole por la url la variable pass, de esta manera en el login.php simplemente reviso si la url esta setiada con la variable pass, si es asi entonces simplemente la muestro
 	if (!empty($resultado)){
 				
 				//Mando a la pagina de email.php el pass y el nombre de usuario del usuario para poder enviarlo a su correo
 		 		header('location:email.php?pass='.$pass.'&user='.$user);

 		 		//header('location:login.php?pass='.$pass);


 	}else{
 		
 	 	

 		header('location:recuperar.php?error&pregunta='.$pregunta.'&user='.$user);
 	}

 ////////////////////////CODIGO SI LE DA EN RECUPERAR CONTRASENA//////////////////////////////////////////////////




 }







require'views/recuperar.view.php';
?>