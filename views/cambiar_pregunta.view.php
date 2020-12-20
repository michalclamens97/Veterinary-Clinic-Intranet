<?php 

//Obtengo la fecha actual
$diaActual=date("d");
$mesActual=date("m");
$anioActual=date("Y");
//Organizo la fecha en el formato que esta en la base de datos (yyyy/mm/dd)
$fechaActual = $anioActual .'-'. $mesActual .'-'. $diaActual;



$conexion = conexion($bd_config);
if (!$conexion) {
	echo "ERROR";
}

//Hago una consulta seleccionando todos los datos donde la proxima cita sea la misma fecha de hoy
$statement = $conexion->prepare('SELECT * FROM consulta WHERE PROXIMA_CITA = :fecha_actual');
$statement->execute(array(':fecha_actual' => $fechaActual));
$resultados = $statement->fetchAll();

//Guardo el numero de resultados obtenidos
$total= count($resultados);
//Para mostrar cuantas citas hay
//echo count($resultados);

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Clínica Veterinaria La Mascota</title>
	<link rel="shortcut icon" href="img/logo2.png">
	
	<link rel="shortcut icon" href="img/foto.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_pruebaFomularioCliente.css">

	<style type="text/css">

		.menu li{
			list-style: none;
		}

		.menu a{
			text-decoration: none;
		}

		button{
			cursor: pointer;
		}

		.wrapper {
  			margin: 1em;
  			margin-bottom: 0;
  			margin-top: 0;
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
		
		h3{
			color: white;
			font-weight: bold;
		}
			.wrapper:hover {
  			background-color: #3498db;
		}
		.pruebaBoton{
			background-color: #2ecc71;
			color: white;
		}
		.pruebaBoton:hover{	
			color: black;
		}
		/*Para que se muestren las opciones del select*/
		#ui option.one{
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

		#form_registro input[type = "text"].error{
			border: 2px solid #FF0000;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			
			<?php require'views/HeadTipo1.php'; ?>

				<!--Columna de relleno-->
			<div class="col-md-1"></div>

				<!--Columna para el contenido principal(para las cartas)-->
			<div class="col-md-7 mt-4 ">
				<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>

			<div id="ui">
			
		
								<h1 class="text-center">Cambiar Pregunta<br>Seguridad</h1>
								<br>
									<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="form-group text-center" id="form_registro" method="POST">
									<div class="row justify-content-center">
										<div class="col-md-8">
											<label>Selecciona una pregunta<br>Pregunta actual: <?php echo $pregunta; ?></label><br>
											<select name="pregunta" class="required form-control"  title="Campo Obligatorio" >
												<option value="" disabled="" selected="">Selecciona una pregunta</option>
												<option class="one" value="color favorito?">Color Favorito?</option>
												<option class="one" value="bebida favorita?">Bebida Favorita?</option>
												<option class="one" value="serie de tv favorita?">Serie de tv favorita?</option>
												<option class="one" value="película favorita?">Película Favorita?</option>
												
											</select>
										</div>
									</div>
											<br>
									<div class="row justify-content-center">
										<div class="col-md-8">
											<label for="respuesta">Ingrese su respuesta:</label>
											<input type="text" name="respuesta" id="respuesta" class="required form-control"  title="Campo Obligatorio" placeholder="Respuesta...">
										</div>
									</div>
											<br>
									<div class="row justify-content-center">
										<div class="col-md-10">
											<button type="submit" class="pruebaBoton btn btn-block btn-lg mb-1">Cambiar Pregunta</button>
										</div>
									</div>
										</form>
								</div>
				<br>		
				<br>
				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>
						</div>
					<div class="col-md-1"></div>
				</div>
			</div>

				
				



</body>




<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="jqueryValidate/validate.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!--VALIDACIONES-->
<script type="text/javascript" src="js/formulario_consulta_validate.js"></script>
</html>
