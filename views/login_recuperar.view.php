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
			
			function JSalertError(){
				swal("Error!", "No se encontro a ese usuario!", "warning");
			}
		</script>
</head>
<body>
	<img src="img/logo2.png" class="logo">
	<form class="box"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
		<h1 >Ingrese su usuario</h1>
		<input type="text" placeholder="Usuario" name="usuario" style="margin-left: 15px;">		
		<input type="submit" name="inicio" id="boton" value="Recuperar" >
		




	</form>

				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>
</body>
</html>

<?php
if (isset($_GET['error'])) {

			echo"
				<script>

				JSalertError();

				</script>
			";
		}


?>