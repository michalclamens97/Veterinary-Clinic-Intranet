<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Clínica Veterinaria La Mascota</title>
	<link rel="shortcut icon" href="img/logo2.png">
	<script type="text/javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/estilos_login.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<style type="text/css">
		.error{
			color: red;
		}
		.pass{
			color: green;
		}

		.logo{
			margin-top: 50px;
			margin-left: 130px;
			width: 650px;
		}

	</style>
<script type="text/javascript" src="js/sweetalert.js"></script><!--PLUGIN DE LA NOTIFICACION-->
		<!--FUNCIONES PARA LAS NOTIFICACIONES -->
		<script type="text/javascript">
			function JSalertEnviado(){
				swal("Exito!", "Se le envio la contraseña a su correo!", "success");
			}

			function JSalertErrorCorreo(){
				swal("Error!", "No se pudo enviar la contraseña a su correo!", "warning");
			}

			function JSalertError(){
				swal("Error!", "Usuario o contraseña incorrecta!", "warning");
			}
		</script>
</head>
<body>
	<img src="img/logo2.png" class="logo">
	<form class="box"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<h1 >Iniciar Sesión</h1>
			<div class="input-group">
				<span class="input-group-addon transparent"><i class="icon icon-user" aria-hidden="true"></i></span>
				<input class="form-control" type="text" placeholder="Usuario" name="usuario">
				<br>
				<span class="input-group-addon transparent"><i class="icon icon-login" aria-hidden="true"></i></span>
				<input class="form-control" type="password" placeholder="Contraseña" name="password" >	
			</div>	
		<input type="submit" name="inicio" id="boton" value="Iniciar Sesión" >
		
			<?php
			//VERIFICA SI ESTA SETIADA LA VARIABLE PASS EN LA URL(ESTO LO HAGO EN RECUPERAR.PHP), ES DECIR SI YA RESPONDI A LA PREGUNTA DE SEGURIDAD DE MANERA CORRECTA, SI HICE ESTO ENTONCES DEBO TENER LA VARIABLE PASS EN MI URL 
				if(isset($_GET['pass']))
				{
				?>
					<div class="pass">
						<?php
							
							echo "Su contraseña es: " .$_GET['pass'];
								
				}
 						?>
					</div>

		<hr>
		<p class="texto-registrate"> Olvidaste tu Contraseña? <a href="login_recuperar.php" class="prueba" id="recuperar">Recuperar Contraseña</a></p>
	</form>


				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>
</body>
</html>

	<?php

		if (isset($_GET['enviado'])) {

			echo"
				<script>

				JSalertEnviado();

				</script>
			";
		}

		if (isset($_GET['errorCorreo'])) {

			echo"
				<script>

				JSalertErrorCorreo();

				</script>
			";
		}

		if (isset($_GET['error'])) {

			echo"
				<script>

				JSalertError();

				</script>
			";
		}

		?>