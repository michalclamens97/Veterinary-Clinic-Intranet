<?php 


//Obtengo la fecha actual
$diaActual=date("d");
$mesActual=date("m");
$anioActual=date("Y");
//Organizo la fecha en el formato que esta en la base de datos (yyyy/mm/dd)
$fechaActual = $anioActual .'-'. $mesActual .'-'. $diaActual;

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Clínica Veterinaria La Mascota</title>
	<link rel="shortcut icon" href="img/logo2.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_pruebaFomularioCliente.css">
	<script type="text/javascript" src="js/sweetalert.js"></script><!--PLUGIN DE LA NOTIFICACION-->
		<!--FUNCIONES PARA LAS NOTIFICACIONES -->
		<script type="text/javascript">
		

			function JSalertError(){
				swal("Error!", "Contraseña Incorrecta", "warning");
			}
		</script>
	
	<style type="text/css">
		
			.menu li{
			list-style: none;
		}

		.menu a{
			text-decoration: none;
		}
		
		#ui{
			color: white;
			margin-right: 60px;
			margin-top: 40px;
		}
		#guardar{
			cursor: pointer;
		}
		

		.wrapper {
  			margin: 1em;
  			margin-bottom: 0;
  			margin-top: 20px;
  			margin-left: 80%;
  			opacity: 0.9;
			background-color: #262a34;
  			cursor: pointer;
  			color: white;
		}
		.wrapper:hover {
  			background-color: #2ecc71;
  			color:black;
		}
		
		.pruebaBoton{
			background-color: #2ecc71;
			color: white;
		}
		.pruebaBoton:hover{	
			color: black;
		}

/* ------------
		

/* ------------------VALIDACIONES ESTILOS---------------------------*/
		#form_registro .indent label.error {
  			margin-left: 0;
			}


		#form_registro label.error{
	
			font-size: 0.8em;
			color: #fff;
			font-weight: bold;
			display: block;
			margin-left:auto;

		}
		#form_registro select.error{
			border: 2px solid #FF0000;
		}

		#form_registro input[type = "password"].error{
			border: 2px solid #FF0000;
		}	
	
	</style>
</head>
<body>

	<!--Contenedor Principal-->
	<div class="container-fluid">
		<!--Fila principal-->
		<div class="row">
			<?php require'views/HeadTipo1.php'; ?>
			
				<!--Columna de relleno-->
			<div class="col-md-1"></div>

			<!--Columna principal de mi formulario-->
			<div class="col-md-7 mt-4 ">
			<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>
				<!--Contenedor para darle estilos al formulario-->
				<div id="ui">
					<h1 class="text-center">Formulario Contraseña</h1>
					<form class="form-group text-center" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="form_registro" method="POST">
						<br>
						
						<!--Fila para el pass viejo-->
						<div class="row justify-content-center">
							<!--Columna para el pass viejo-->
							<div class="col-md-6 error">
								<label for="password">Ingrese su contraseña anterior:</label>
								<input type="password" name="password" id="password" class="required form-control"  title="Campo Obligatorio" placeholder="Contraseña anterior">
							</div>
						</div><!--Fin fila pass viejo-->
												
						<br>

						<!--Fila para el pass nuevo-->
						<div class="row justify-content-center">
						<!--Columna para el pass nuevo-->
							<div class="col-md-6">
								<label for="password_nueva">Ingrese su contraseña nueva:</label>
								<input type="password" name="password_nueva" id="password_nueva" class="form-control"  placeholder="Contraseña nueva...">
							</div>
						</div><!--Fin fila pass nuevo-->
						<br>

						<!--Fila para el confirmar pass nuevo -->
						<div class="row justify-content-center">
						<!--Columna para el confirmar pass nuevo-->
							<div class="col-md-6">
								<label for="password_confirma">Confirme su contraseña nueva:</label>
								<input type="password" name="password_confirma" id="password_confirma" class="form-control"  placeholder="Contraseña nueva...">
							</div>
						</div><!--Fin fila confirmar pass nuevo-->
						<br>

						<!--Fila para el submit-->
						<div class="row justify-content-center">
							<div class="col-md-10">
								<input type="submit" name="guardar" id="guardar" class="pruebaBoton btn btn-block btn-lg" value="Guardar">
							</div>
						</div><!--Fin fila del submit-->
					</form><!--Fin formulario-->
				</div><!--Fin del contendor para dar los estilos-->
				<br>		
				<br>
				
				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>
			</div><!--Fin de la columna principal la cual tiene todo el formulario-->
			
		<div class="col-md-1"></div>
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<!--PLUGIN PARA LAS VALIDACIONES (DEBE IR DEBAJO DE jquery)-->
<script type="text/javascript" src="jqueryValidate/validate.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/select_dinamico.js"></script>
<script type="text/javascript" src="js/main.js"></script>


<!--VALIDACIONES-->
<script type="text/javascript" src="js/formulario_contrasena_validate.js"></script>

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