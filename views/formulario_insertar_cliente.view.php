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
	<script type="text/javascript">
			function JSalert(){
				swal("ERROR", ", Ya hay un cliente registrado con esa cedula!", "warning");
			}

		</script>


	<title>Formulario Cliente por Primera ves</title>

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
			margin-top: 25px;
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
	</style>
</head>
<body>

	<!--Contenedor Principal-->
	<div class="container-fluid">
		<!--Fila principal-->
		<div class="row">
			<?php require'views/HeadTipo1.php'; ?>
				
				<!--Columna de relleno-->
			<div class="col-md-1">
			</div>
			<!--Columna principal de mi formulario-->
			<div class="col-md-8 mt-3">
			<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>
				<!--Contenedor para darle estilos al formulario-->
				<div id="ui">
					<h1 class="text-center">Formulario Cliente</h1>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="form_registro" class="form-group text-center">
						<!--Fila para el nombre, apellido y cedula-->
						<div class="row">
							<!--Columna para el nombre-->
							<div class="col-md-4">
								<label for="nombre">Nombre Cliente:</label>
								<input type="text" name="nombre" id="nombre" class="form-control required" title="Campo Obligatorio" placeholder="Nombre cliente...">
							</div>
							<!--Columna para el apellido-->
							<div class="col-md-4">
								<label for="apellido">Apellido Cliente:</label>
								<input type="text" name="apellido" id="apellido" class="form-control required" title="Campo Obligatorio" placeholder="Apellido cliente...">
							</div>
							<!--Columna para la cedula-->
							<div class="col-md-4">
								<label for="cedula">Cédula Cliente (V-E):</label>
								<input type="text" name="cedula" id="cedula" class="form-control required" title="Campo Obligatorio" placeholder="Cédula cliente...">
							</div>
						</div> <!--Fin fila del nombre, apellido y cedula-->
						<br>

						<!--Fila para el telefono y la direccion-->
						<div class="row">
							<!--Columna para el telefono-->
							<div class="col-md-6">
								<label for="telefono">Teléfono Cliente:</label>
								<input type="text" name="telefono" id="telefono" class="form-control required" title="Campo Obligatorio" placeholder="Teléfono cliente...">
							</div>
							<!--Columna para la direccion-->
							<div class="col-md-6">
								<label for="direccion">Dirección Cliente:</label>
								<input type="text" name="direccion" id="direccion" class="form-control required" title="Campo Obligatorio" placeholder="Dirección cliente...">
							</div>
						</div><!--Fin fila telefono y direccion-->
						<br>

						<!--Fila para el nombre de la mascota, peso y edad(la edad a futuro sera fecha de nacimiento)-->
						<div class="row">
							<!--Columna para el nombre de la mascota-->
							<div class="col-md-4">
								<label for="nombre_mascota">Nombre Mascota:</label>
								<input type="text" name="nombre_mascota" id="nombre_mascota" class="form-control required" title="Campo Obligatorio" placeholder="Nombre mascota...">
							</div>
							<!--Columna para la edad de la mascota-->
							<div class="col-md-4">
								<label for="edad">Fecha Nacimiento:</label>
								<input type="date" max="<?php echo $fechaActual; ?>" name="edad" id="edad" class="form-control required" title="Fecha Incorrecta">
							</div>
							<!--Columna para el peso-->
							<div class="col-md-4">
								<label for="peso">Peso Mascota(Gr):</label>
								<input type="text" name="peso" id="peso" class="form-control required" title="Campo Obligatorio" placeholder="Peso mascota...">
							</div>
						</div><!--Fin fila nombre mascota, edad y peso-->
						<br>

						<!--Fila para la raza, especie,sexo y esterelizado-->
						<div class="row">

						<!--Columna para la especie-->
							<div class="col-md-3">
								<label for="raza">Especie:</label>
								<select name="especie" id="especie" class="form-control required" title="Seleccione una opción">
									<option value="especie" selected disabled>Especie</option>
									<?php foreach ($resultado as $dato): ?>
									<option class="one" value="<?php echo $dato['ESPECIE']; ?>"><?php echo ucwords($dato['ESPECIE']); ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<!--Columna para la raza de la mascota-->
							<div class="col-md-3">
								<label for="raza">Raza Mascota:</label>
								<select name="raza" id="raza" class="form-control required" title="Seleccione una opción">
								
								</select>
							</div>
							<!--Columna para el sexo de la mascota-->
							<div class="col-md-3">
								<label for="sexo">Sexo Mascota:</label>
								<select name="sexo" class="form-control required" title="Seleccione una opción">
									<option class="one" value="sexo" selected disabled>Sexo</option>
									<option class="one" value="macho">Macho</option>
									<option class="one" value="hembra">Hembra</option>
								</select>
							</div>
							<!--Columna para el esterelizado de la mascota-->
							<div class="col-md-3">
								<label for="esterilizacion">Esterilización:</label>
								<select name="esterilizacion" class="form-control required" title="Seleccione una opción">
									<option class="one" value="esterilizacion" selected disabled>Esterilizado</option>
									<option class="one" value="Si">Si</option>
									<option class="one" value="No">No</option>
								</select>
							</div>
						</div><!--Fin fila raza, sexo, especie y esterelizado-->
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
			
		
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<!--PLUGIN PARA LAS VALIDACIONES (DEBE IR DEBAJO DE jquery)-->
<script type="text/javascript" src="jqueryValidate/validate.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/select_dinamico.js"></script>
<!--Plugin para la mascara del telefono-->
<script type="text/javascript" src="js/jquery-maskedinput.1.4.1.min.js"></script>
<script type="text/javascript">

     $(document).ready(function($)
     {
     //Mascara del telefono
     $('#telefono').mask('(9999) 999-9999');
     $("#peso").change(function(){

			var peso = "Kg " + $(this).val()/1000 ;

			$(this).val(peso);

		});


	$("#peso").click(function(){

		$(this).val("");
	
	});

     });

	</script>

<!--VALIDACIONES-->
<script type="text/javascript" src="js/insertar_cliente_validate.js"></script>

<!--VALIDACION CEDULA-->
<script type="text/javascript" src="js/maskCedula.js"></script>
<script type="text/javascript" src="js/validacion_cedula.js"></script>

<!--VALIDACION SOLO LETRAS O NUMEROS-->
<script type="text/javascript" src="js/validaLetrasNumeros.js"></script>
 <script type="text/javascript">
            $(function(){
                //Para escribir solo letras
                $('#nombre').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú');
                $('#apellido').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú');
                $('#nombre_mascota').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú');
                $('#peso').validCampoFranz('0123456789,.');        
            });
        </script>        
</body>
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


								