<?php 
session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();
 comprobarUsuario();

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
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/sweetalert.js"></script><!--PLUGIN DE LA NOTIFICACION-->
	<!--FUNCIONES PARA LAS NOTIFICACIONES -->
		<script type="text/javascript">
			function JSalertConsulta(){
				swal("Exito!", "La consulta fue creada!", "success");
			}

			function JSalertVacunacion(){
				swal("Exito!", "Certificado de vacunación creado!", "success");
			}
			
			function JSalertParasitos(){
				swal("Exito!", "Constancia de desparasitación creada!", "success");

			}

			function JSalertInforme(){
				swal("Exito!", "Informe médico creado!", "success");

			}

			function JSalertCliente(){
				swal("Exito!", "Cliente Agregado!", "success");

			}
		</script>

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
		.prueba{
			 background-color:  #262a34;
			 color: white;
		}
		.pruebaBoton{
			background-color: #2ecc71;
			color: white;
		}
		.pruebaBoton:hover{	
			color: black;
		}
		
	
	</style>
</head>
<body>
	<!--Contenedor Principal-->
	<div class="container-fluid">
		<!--Fila principal-->
		<div class="row">

			<?php require'views/HeadTipo1.php';?>
			
			<!--Columna para el contenido principal(para las cartas)-->
			<main class="main col-md-9">
				<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>
				<!--Fila para la primera seccion de mi contenido principal-->
				<div class="row " style="margin-left: 15px;">
					<!--Columna para las cartas-->
					<div class="columna col-md-12 mt-4">
						<div class="card-columns">
							<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Realizar <br> Consulta</h3>
								<a href="mostrar_clientes_consultas_dataTable.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-stethoscope"></i></a>
								</div>
							</div>

							<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Certificado <br> Vacunación</h3>
								<a href="mostrar_clientes_vacunacion_dataTable.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-pipette"></i></a>
								</div>
							</div>
							

							<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Panel <br> Administración</h3>
								<a href="index_administracion.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-doc-text"></i></a>
								</div>
							</div>

							<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Constancia <br> Parásitos</h3>
								<a href="mostrar_clientes_desparasitacion_dataTable.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-bug"></i></a>
								</div>
							</div>

							<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Informe <br> Médico</h3>
								<a href="mostrar_consultas_informe_medico_dataTable.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-doc-add"></i></a>
								</div>
							</div>
							
							<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Mantenimiento<br>Base de datos</h3>
								<a href="backup-restore/php/index.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-database"></i></a>
								</div>
							</div>
						</div>
					</div><!--Fin columna para las cartas-->
				</div><!--Fin fila de la primera seccion de mi contenido principal-->
				
				<!--Fila para el contenido secundario-->
				<div id="secundario" class="row" style="margin-left: 15px;">
					<!--Columna para el contenido secundario-->
					<div class="col mt-2">
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
				</div><!--Fin fila del contenido secundario-->

				
				<br>
				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b><br></p>
			</main><!--Fin columna para el contenido principal-->
			
			<!--Columna de relleno-->
			<div class="col-md-1"></div><!--Fin columna de relleno-->

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
						<h4 class="modal-title" id="myModalLabel"><b><i class="icon-clipboard"></i>Observaciones</b></h4>
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
						<h4 class="modal-title" id="myModalLabel"><b><i class="icon-medkit"></i>Tratamiento</b></h4>

					</div>
					
					<div class="modal-body" id="mostrar3">
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>


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


<script type="text/javascript" src="js/main.js"></script>
</body>

<!--REVISO SI TENGO EN LA URL ALGUNA VARIABLE DE NOTIFICACIONES, SI ES ASI ENTONCES LLAMO A LA FUNCION DE JS PARA MOSTRAR NOTIFICACION DE EXITO-->
	<?php

		if (isset($_GET['consultaFin'])) {

			echo"
				<script>

				JSalertConsulta();

				</script>
			";
		}

		if (isset($_GET['vacunacionFin'])) {

			echo"
				<script>

				JSalertVacunacion();

				</script>
			";
		}

		if (isset($_GET['parasitosFin'])) {

			echo"
				<script>

				JSalertParasitos();

				</script>
			";
		}

		if (isset($_GET['informeFin'])) {

			echo"
				<script>

				JSalertInforme();

				</script>
			";
		}

		if (isset($_GET['clienteFin'])) {

			echo"
				<script>

				JSalertCliente();

				</script>
			";
		}
	?>
</html>