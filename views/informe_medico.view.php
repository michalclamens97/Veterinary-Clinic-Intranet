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
	
<style type="text/css">
		
			.menu li{
			list-style: none;
		}

		.menu a{
			text-decoration: none;
		}
		
		#ui{
			color: black;
			margin-right: 60px;
			margin-top: 20px;
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
		.prueba{
			 background-color:  #262a34;
			 color: white;
		}
		.pruebaBoton{
			background-color: #2ecc71;
			color: white;
			cursor: pointer;
		}
		.pruebaBoton:hover{	
			color: black;
		}

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
		
		#form_registro input[type = "date"].error{
			border: 2px solid #FF0000;
		}
		#form_registro input[type = "text"].error{
			border: 2px solid #FF0000;
		}
		#form_registro textarea.error{
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
			<div class="col-md-8 mt-3">
			<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>
				<!--Contenedor para darle estilos al formulario-->
				<div id="ui">
					<h1 class="text-center">Formulario Informe Médico</h1>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="form_registro" class="form-group text-center">

						<!--Fila mostrar nombre,motivo de la consulta y procedimientos-->
						<div class="row mt-3">
							<!--Columna para el nombre-->
							<div class="col-md-4">
								<label for="mostrar_nombre">Nombre Mascota:</label>
								<input type="text" name="mostrar_nombre" value="<?php echo $nombre_mascota; ?>" disabled>	
							</div>
							<!--Columna para el motivo-->
							<div class="col-md-4">
								<label for="mostrar_motivo">Motivo Consulta:</label>
								<input type="text" name="mostrar_motivo" value="<?php echo $motivo; ?>" disabled>
							</div>
							<!--Columna para los procedimiento-->
							<div class="col-md-4">
								<label for="mostrar_procedimientos">Procedimientos:</label>
								<input type="text" name="mostrar_procedimientos" value="<?php echo $procedimientos; ?>" disabled>
							</div>
						</div> <!--Fin fila para mostrar nombre,motivo de la consulta y procedimientos-->
						<br>
						<div class="row">
							<div class="col-md-12">
								<label for="mostrar_ob">Tratamiento</label>
								<textarea class="form-control" name="mostrar_tr" style="min-height: 80px;" disabled><?php echo $tratamiento; ?></textarea>
							</div>
						</div>
						<br>
						<!--Fila para las observaciones-->
						<div class="row">
							<div class="col-md-12">
								<label for="mostrar_ob">Observaciones</label>
								<textarea class="form-control" name="mostrar_ob" style="min-height: 80px;" disabled><?php echo $observaciones; ?></textarea>
							</div>
						</div>
						<br>
						<!--Fila para el informe medico-->
						<div class="row">
							<!--Columna para el informe medico-->
							<div class="col-md-12">
								<label for="informe">Informe medico:</label>
								<textarea class="required form-control" style="min-height: 100px; " name="informe" id="informe" placeholder="Informe medico..." title="Campo Obligatorio"></textarea>
								<br/>
							</div>
							<input type="text" name="cedula" hidden="true" value="<?php echo "$cedula"; ?>">
							<input type="text" name="id_mascota" hidden="true" value="<?php echo "$id_mascota"; ?>">
							<input type="text" name="nombre_mascota" hidden="true" value="<?php echo "$nombre_mascota"; ?>">
							<input type="text" name="motivo" hidden="true" value="<?php echo "$motivo";?>">
							<input type="text" name="procedimientos" hidden="true" value="<?php echo "$procedimientos";?>">
							<input type="text" name="observaciones" hidden="true" value="<?php echo "$observaciones";?>">
							<input type="text" name="fecha_cita" hidden="true" value="<?php echo "$fecha_cita";?>">
							<input type="text" name="proxima_cita" hidden="true" value="<?php echo "$proxima_cita";?>">
							<input type="text" name="precio" hidden="true" value="<?php echo "$precio";?>">
							<input type="text" name="medicamentos" hidden="true" value="<?php echo "$medicamentos";?>">

							
						</div> <!--Fin fila del informe medico-->
						
						<!--Fila para el submit-->
						<div class="row">
							<div class="col">
								<input type="submit" name="guardar" id="guardar" class="pruebaBoton btn btn-block btn-lg" value="Guardar">
							</div>
						</div><!--Fin fila del submit-->
					</form><!--Fin formulario-->
				</div><!--Fin del contendor para dar los estilos-->
				<br>
				<p style="text-align:center;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>
			</div><!--Fin de la columna principal la cual tiene todo el formulario-->
			
			<!--Columna de relleno-->
			<div class="col-md-2"></div>
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<!--PLUGIN PARA LAS VALIDACIONES (DEBE IR DEBAJO DE jquery)-->
<script type="text/javascript" src="jqueryValidate/validate.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/main.js"></script>


<!--VALIDACIONES-->
<script type="text/javascript" src="js/formulario_consulta_validate.js"></script>

</body>
</html>


								