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

			.principal { 
		max-width: 100%; 
		width: auto !important; 
		display: inline-block;
		text-align: center;
		margin-left: 350px;
		}
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
		
		#secundario{
			margin-right: 40px;
		}
		
		button{
			cursor: pointer;
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
			<main class="main col-md-8">
			<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>
				<!--Contenedor para darle estilos al formulario-->
				<div id="ui">
					<h1 class="text-center">Formulario Cliente</h1>
					<?php foreach ($resultado as $fila): ?>
		
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="form_registro" class="form-group text-center">
						
						<!--Aqui pongo la cedula que capture por get en editar_cliente.php, esto lo necesito para saber a que cliente es al que le voy a editar sus datos-->	
						<input hidden="true" type="text" name="cedula" class="usuario" id="cedula" value="<?php echo $fila['CEDULA'] ?>" >
						
						<!--Fila para el nombre y apellido-->
						<div class="row">
							<!--Columna para el nombre-->
							<div class="col-md-6">
								<label for="nombre">Nombre Cliente:</label>
								<input type="text" name="nombre" id="nombre" class="required form-control" title="Campo Obligatorio" placeholder="<?php echo $fila['NOMBRE'] ?>" value="<?php echo $fila['NOMBRE'] ?>">
							</div>
							<!--Columna para el apellido-->
							<div class="col-md-6">
								<label for="apellido">Apellido Cliente:</label>
								<input type="text" name="apellido" id="apellido" class="required form-control" title="Campo Obligatorio" placeholder="<?php echo $fila['APELLIDO']  ?>" value="<?php echo $fila['APELLIDO']  ?>">
							</div>
						</div><!--Fin fila nombre y apellido-->
						<br>
						<!--Fila para el telefono y la direccion-->
						<div class="row">
							<!--Columna para la cedula-->
							<div class="col-md-4">
								<label for="cedula_nueva">Cedula:</label>
								<input type="text" name="cedula_nueva" id="cedula_nueva" class="required form-control" title="Campo Obligatorio" placeholder="<?php echo $fila['CEDULA']?>" value="<?php echo $fila['CEDULA'] ?>">
							</div>
							<!--Columna para el telefono-->
							<div class="col-md-4">
								<label for="telefono">Teléfono Cliente:</label>
								<input type="text" name="telefono" id="telefono" class="required form-control" title="Campo Obligatorio" placeholder="<?php echo $fila['TELEFONO'] ?>" value="<?php echo $fila['TELEFONO'] ?>">
							</div>
							<!--Columna para la direccion-->
							<div class="col-md-4">
								<label for="direccion">Dirección Cliente:</label>
								<input type="text" name="direccion" id="direccion" class="required form-control" title="Campo Obligatorio" placeholder="<?php echo $fila['DIRECCION']  ?>" value="<?php echo $fila['DIRECCION']  ?>">
							</div>
						<?php endforeach ?><!--Fin ciclo foreach con los resultados-->
						</div><!--Fin fila telefono y direccion-->
						<br>


						<!--Fila para el submit-->
						<div class="row">
							<div class="col">
								<input type="submit" name="guardar" id="guardar" class="pruebaBoton btn btn-block btn-lg" value="Guardar">
							</div>
						</div><!--Fin fila del submit-->
					</form><!--Fin formulario-->
					
				</div><!--Fin del contendor para dar los estilos-->
				<!--Fila para el contenido secundario-->
				<div id="secundario" class="row">
					<!--Columna para el contenido secundario-->
					<div class="col mt-3">
						<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title"><bold>Consultas del día de hoy</bold></h3>
								<p class="card-text">Hay <?php echo $total; ?> consultas para el día de hoy</p>
								<!--Es decir antes de crear el boton para ver las citas del dia, primero reviso si total es diferente de cero, es decir si se encontraron citas para el dia de hoy creo el boton que me va a mandar a consultas_dia.php en donde voy a mostrar las consultas del dia, haciendo una consulta a la bd con la fecha actual que le estoy pasando por la url. De lo contrario, sino se encontraron citas para el dia de hoy entonces creo un boton que no mande a ninguna pagina y que diga, lo sentimos no hay citas para el dia de hoy-->
								<?php
									//SI HAY CITAS PARA EL DIA DE HOY
									if ($total != 0) {
								?>		
										<!--FALTA CREAR consultas_dia.php -->
									<button  id="<?php echo $fechaActual; ?>" class="view_data pruebaBoton btn btn-block btn-lg">Ver consultas del día</button>
					
								<?php
									//SINO HAY CITAS PARA EL DIA DE HOY
									}else{
									?>
									<a href="#"  class="pruebaBoton btn btn-block btn-lg">No hay consultas para el día de hoy!!</a>
								<?php
									}
								?>
								
								</div>
							</div>
					</div><!--Fin columna del contenido secundario-->
				</div><!--Fin fila del contenido secundario-->\<br>
				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>
			</main><!--Fin de la columna principal la cual tiene todo el formulario-->
			
			<!--Columna de relleno-->
			<div class="col-md-2"></div>
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->

	<!-- Modal 1-->
		<div class="modal fade" id="dataModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog principal modal-lg">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					
					<div class="modal-body" id="mostrar">
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>	

		<!-- Modal 2 (OBSERVACIONES)-->
		<div class="modal fade" id="dataModal2"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					
					<div class="modal-body" id="mostrar2">
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

			<!-- Modal 3 (TRATAMIENTO)-->
		<div class="modal fade" id="dataModal3"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					
					<div class="modal-body" id="mostrar3">
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>

<!--PLUGIN PARA LAS VALIDACIONES (DEBE IR DEBAJO DE jquery)-->
<script type="text/javascript" src="jqueryValidate/validate.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<!--Plugin para la mascara del telefono-->
<script type="text/javascript" src="js/jquery-maskedinput.1.4.1.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">

     $(document).ready(function($)
     {


     $('#telefono').mask('(9999) 999-9999');
     });

	</script>

<!--VALIDACIONES-->
<script type="text/javascript" src="js/formulario_vacuna_validate.js"></script>
<!--VALIDACION CEDULA-->
<script type="text/javascript" src="js/maskCedula.js"></script>
<script type="text/javascript" src="js/validacion_cedula_nueva.js"></script>

</body>

<script type="text/javascript">
	$(document).ready(function(){
		//Accedo a traves de su clase view_Data al boton al que se le dio click
		$('.view_data').click(function(){
			//Guarddo el id que tiene el boton(este id tiene la fecha del dia que necesito para saber cuales son las consultas del dia)
			var fecha_dia = $(this).attr("id");
			
			$.ajax({
				url:"consultas_dia.php",
				method:"post",
				data:{fecha_dia:fecha_dia},
				success:function(data){
					//Accedo al cuerpo del modal a traves de su id y le concanteno los resultados, entre estos resultados esta el boton con las observaciones el cual tiene como id modal2, y las observaciones estan guardadas en el atributo id del boton, esto lo hago en consultas_dia.php 
					$('#mostrar').html(data);
					//Accedo al modal completo a traves de su id y lo muestro
					$('#dataModal').modal("show");

					//Accedo al boton que esta dentro del primer modal el cual tiene las observaciones en su id (este boton es parte de los resultados que me traje con ajax), este id se llama modal2, a este boton le agrego un evento de tipo click
					$('.modal2').click(function(){
						//Guardo el id que tiene el boton del modal  (en este id tengo las observaciones)
						var observaciones = $(this).attr("id");
						//Accedo al cuerpo del modal 2 a traves de su id y le concanteno los resultados(las observaciones)
						$('#mostrar2').html(observaciones);
						//Accedo al modal 2 completo a traves de su id y lo muestro
						$('#dataModal2').modal("show");
					});

					//TRATAMIENTO
					$('.modal3').click(function(){
						//Guardo el id que tiene el boton del modal  (en este id tengo las observaciones)
						var tratamiento = $(this).attr("id");
						//Accedo al cuerpo del modal 2 a traves de su id y le concanteno los resultados(las observaciones)
						$('#mostrar3').html(tratamiento);
						//Accedo al modal 2 completo a traves de su id y lo muestro
						$('#dataModal3').modal("show");
					});

				}//Fin success de ajax

			});

		});
//BUSCAR LA MANERA DE MOSTRAR LAS OIBSERVACIONES EN UN SEGUNDO MODAL


	});
</script>

</html>