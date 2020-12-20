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
	<script type="text/javascript" src="js/sweetalert.js"></script><!--PLUGIN DE LA NOTIFICACION-->
	<script type="text/javascript">
			function JSalert(){
				swal("ERROR", ", Ya hay un usuario registrado con ese nombre!", "warning");
			}

		</script>

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
		
		#form_registro input[type = "date"].error{
			border: 2px solid #FF0000;
		}
		#form_registro input[type = "text"].error{
			border: 2px solid #FF0000;
		}
		#form_registro input[type = "password"].error{
			border: 2px solid #FF0000;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<?php require'views/HeadTipo1.php'; ?>
			
			<div class="col-md-1"></div>

				<!--Columna para el contenido principal(para las cartas)-->
			<div class="col-md-7 mt-4">
			<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>
			<!--Fila para las carta de registrar usuario-->
			<div id="ui">
			
								<h1 class="text-center">Registrar Usuario</h1>
								<br>
									<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="form_registro" method="POST" class="form-group text-center">
										<!--Fila para el usuario, pass y repass-->
											<div class="row">
											<!--Columna para el usuario-->
												<div class="col-md-4">
													<label for="usuario">Usuario:</label>
													<input type="text" name="usuario" id="usuario" class="form-control required"  placeholder="Usuario..." title="Campo Obligatorio">
												</div>

												<!--Columna para el pass-->
												<div class="col-md-4">
													<label for="pass">Contraseña:</label>
													<input type="password" name="pass" id="pass" class="form-control"  placeholder="Contraseña...">
												</div>

												<!--Columna para el repass-->
												<div class="col-md-4">
													<label for="repass">Confirmar:</label>
													<input type="password" name="repass" id="repass" class="form-control"  placeholder="Contraseña...">
												</div>
											</div><!--Fin fila usuario, pass y repass-->	

											<br>

											<!--Fila para la pregunta y respuesta-->
											<div class="row">
											<!--Columna para la pregunta-->
											<div class="col-md-6">
												<label for="pregunta">Pregunta Seguridad:</label>
													<select name="pregunta" class="required form-control"  title="Campo Obligatorio" >
														<option value="" disabled="" selected="">Selecciona una pregunta</option>
														<option class="one" value="color favorito?">Color Favorito?</option>
														<option class="one" value="bebida favorita?">Bebida Favorita?</option>
														<option class="one" value="serie de tv favorita?">Serie de tv favorita?</option>
														<option class="one" value="película favorita?">Película Favorita?</option>
													</select> 
											</div>
												<!--Columna para la respuesta-->
												<div class="col-md-6">
													<label for="respuesta">Respuesta:</label>
													<input type="text" name="respuesta" id="respuesta" class=" required form-control"  placeholder="Respuesta..." title="Campo Obligatorio">
											    </div>

											</div><!--Fin fila pregunta y respuesta-->			

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
				<br>
				<br>
				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>
			</div><!--Fin de la columna principal la cual tiene todo el formulario-->
			
			<div class="col-md-1"></div>
		
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->
			
			


</body>




<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="jqueryValidate/validate.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!--VALIDACIONES-->
<script type="text/javascript" src="js/registrar_usuario_validate.js"></script>

<!--VALIDACION SOLO LETRAS O NUMEROS-->
<script type="text/javascript" src="js/validaLetrasNumeros.js"></script>
 <script type="text/javascript">
            $(function(){
                //Para escribir solo letras
                $('#usuario').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú');
                       
            });
 </script> 

<?php

		if (isset($_GET['error'])) {

			echo"
				<script>

				JSalert();

				</script>
			";
		}

	?>
</html>
