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
			margin-top: 40px;
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
		/*Para que se muestren las opciones del select*/
		#ui option.one{
			color: black;
		}
/* ----------

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
		#form_registro input[type = "checkbox"].error{
			outline: 2px solid #FF0000;
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
					<h1 class="text-center">Formulario Vacuna</h1>
					<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="form_registro" class="form-group text-center">
						<!--Fila para el nombre, apellido y cedula-->
						<div class="row">
							<!--Hago un foreach con mis resultado del cliente que tengo en  formulario_vacunacion.php y muestro los valores en los inpust-->
							<?php foreach ($resultadoCliente as $dato): ?>
							<div class="col-md-4">
								<label for="nombre">Cliente:</label>
								<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $dato['NOMBRE'];  ?>" disabled>
							</div>
							<div class="col-md-4">
								<label for="cedula">Apellido:</label>
								<input type="text" name="apellido" id="apellido" class="form-control" value="<?php echo $dato['APELLIDO'];  ?>" disabled>
							</div>
							<input type="text" name="direccion" class="form-control" value="<?php echo $dato['DIRECCION'];  ?>" disabled hidden="true">
							<div class="col-md-4">
								<label for="cedula">Cédula:</label>
								<input type="text" name="cedula" id="cedula" class="form-control" value="<?php echo $dato['CEDULA'];  ?>" disabled>
							</div>
							<?php endforeach ?> <!--Fin ciclo foreach de los resultados del cliente-->
						
						</div><!--Fin fila del nombre, apellido y cedula-->
						<br>
						<!--Fila para mascotas, fecha aplicacion y fecha proxima-->
						<div class="row">
							<div class="col-md-4">
								<label for="mascotas">Mascotas:</label>
								<select class="required form-control" title="Selecciona una Mascota" name="mascota">
									<option selected disabled>Mascotas</option>
									<!--Por cada mascota que tenga el cliente hago un option con el nombre de esa mascota, en el value le paso el id de la mascota ya que ese id lo necesito en formulario_vacunacion.php-->
									<?php foreach ($resultadoMascota as $dato): ?>
										<option class="one" value="<?php echo $dato['ID'] ?>"><?php echo ucfirst($dato['NOMBRE']) .' - '. $dato['RAZA'] .' - '. ucfirst($dato['SEXO']); ?></option>
									<?php endforeach ?> <!--Fin foreach de los resultas de las mascotas-->
								</select>
							</div>
							
							

							<div class="col-md-4">
								<label for="f_aplicacion">Fecha Aplicación</label>
								<input type="date" class="required form-control" title="Campo Obligatorio" value="<?php echo $fechaActual; ?>" name="f_aplicacio" id="f_aplicacio" disabled>
								<input type="hidden" class="required form-control" title="Campo Obligatorio" value="<?php echo $fechaActual; ?>" name="f_aplicacion" id="f_aplicacion">
							</div>

							<div class="col-md-4">
								<label for="f_proxima">Fecha Próxima</label>
								<input type="date" class="required form-control" min="<?php echo $fechaActual; ?>" title="Fecha Incorrecta" name="f_proxima" id="f_proxima">
							</div>
						</div><!--Fin Fila para las mascotas, fecha aplicacion y fecha proxima-->
						<br>

						<!--Fila para el item(tipo de vacuna) y la cantidad-->
						<div class="row">
							<div class="col-md-6">
							<label for="vacuna[]">Vacunas:</label>
							<br>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="checkbox" name="vacunas[]" id="vacunas[]" value="Sextuple" class="required" title="Selecciona una opción"> Sextuple
									</label>
								</div>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<input type="checkbox" name="vacunas[]" id="vacunas[]" value="Rabia"> Rabia
									</label>
								</div>
								
							</div>
							<div class="col-md-6">
								<label for="cantidad">Cantidad:</label>
								<input type="text" name="cantidad" id="cantidad" class="required form-control" title="Campo Obligatorio" placeholder="Cantidad....">
							</div>
						</div><!--Fin fila para el item y la cantidad-->
						<br>


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
<script type="text/javascript" src="js/formulario_vacuna_validate.js"></script>

<!--VALIDACION SOLO LETRAS O NUMEROS-->
<script type="text/javascript" src="js/validaLetrasNumeros.js"></script>
 <script type="text/javascript">
            $(function(){
                
                $('#cantidad').validCampoFranz('0123456789');      
            });
        </script> 



</body>
</html>