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
				swal("ERROR!", ", Ya ese medicamento esta registrado!", "warning");
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
			color: black;
			margin-right: 60px;
			margin-top: 60px;
		}

				.wrapper {
  			margin: 1em;
  			margin-bottom: 0;
  			margin-top: 15px;
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
					<h1 class="text-center">Formulario Insertar Medicamentos</h1>
					<br>
					<form class="form-group text-center" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="form_registro" method="POST">
						
				
						<!--Fila para el producto y lote-->
						<div class="row">
							<!--Columna para el producto-->
							<div class="col-md-6">
								<label for="producto">Medicamento:</label>
								<input type="text" name="medicamento" id="medicamento" class="required form-control" title="Campo Obligatorio" placeholder="Medicamento...">
							</div>
							<!--Columna para el lote-->
							<div class="col-md-6">
								<label for="lote">Precio:</label>
								<input type="text" name="precio" id="precio" class="required form-control" title="Campo Obligatorio" placeholder="Precio...">
							</div>
							
						</div><!--Fin fila producto y el lote-->
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
<script type="text/javascript" src="js/select_dinamico.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<!--VALIDACIONES-->
<script type="text/javascript" src="js/formulario_consulta_validate.js"></script>

<!--Validacion Precio-->
<script type="text/javascript" src="js/maskCedula.js"></script>
<script type="text/javascript">

		//Guardo el campo de precio en una constante llamada number
		const number = document.querySelector('#precio');
		//Funcion para colocar los puntos
		function formatNumber (n) {
			n = String(n).replace(/\D/g, "");
  		return n === '' ? n : Number(n).toLocaleString();
		}
		//Le agrego un evento de tipo keyup al precio
		number.addEventListener('keyup', (e) => {
			//Apunto al precio
			const element = e.target;
			//Obtengo el valor del input
			const value = element.value;
			//Creo la mascara que le voy a concatenar al precio
			const mask = 'Bs.';
			//Le asigno el valor al precio en donde le concateno la mascara y ejecuto la funcion para ir colocando los decimales
  			element.value = mask.concat(formatNumber(value));
		});


		//Para limpiar el input en caso de que haya quedado escrito la mascara Bs. solamente
		$('#precio').blur(function(){
			if ($(this).val() == 'Bs.') {
				$(this).val('');	
			}
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
</body>
</html>