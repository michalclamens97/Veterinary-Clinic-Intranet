<?php session_start();
require'admin/config.php';
require'functions.php';

comprobarSession();

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
	<title>Clinica La Mascota</title>
	<link rel="shortcut icon" href="img/logo2.png">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<script type="text/javascript" src="js/sweetalert.js"></script><!--PLUGIN DE LA NOTIFICACION-->
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
			function JSalertRegistro(){
				swal("Exito!", "La especie fue registrada!", "success");
			}

			function JSalertRegistroRaza(){
				swal("Exito!", "La raza fue registrada!", "success");
			}

			function JSalertRegistroMotivo(){
				swal("Exito!", "El motivo fue registrado!", "success");
			}

			function JSalertRegistroProcedimiento(){
				swal("Exito!", "El procedimiento fue registrado!", "success");
			}

			function JSalertEliminacionRaza(){
				swal("Exito!", "La raza fue eliminada!", "success");
			}

			function JSalertEliminacionEspecie(){
				swal("Exito!", "La especie fue eliminada!", "success");

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
  			margin-bottom: 15px;
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

			<?php require'views/HeadTipo1.php'; ?>
			
			<!--Columna para el contenido principal(para las cartas)-->
			<main class="main col-md-9">
			<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>

			<!--Fila para la carta de agregar motivo de consulta y agregar procedimientos (y eliminar)-->
			<div class="row"  style="margin-left: 15px;"">
			<!--Carta para agregar motivo consulta-->
			<div class="col-md-3">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Agregar<br> Motivo</h3>
								<a href="agregar_motivo.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-heartbeat"></i></a>
								</div>

						</div>
				</div>
			</div><!--Fin carta de motivo de consulta-->
			
			<!--Carta para eliminar motivo -->
			<div class="col-md-3">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Eliminar<br> Motivo</h3>
								<a href="eliminar_motivo.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-cancel"></i></a>
								</div>

						</div>
				</div>
			</div><!--Fin carta de eliminar motivo-->

			<!--Carta para agregar procedimiento -->
			<div class="col-md-3">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Agregar<br> Procedimiento</h3>
								<a href="agregar_procedimiento.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-hospital"></i></a>
								</div>

						</div>
				</div>
			</div><!--Fin carta de agregar procedimiento-->


			<!--Carta para eliminar procedimiento -->
			<div class="col-md-3">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Editar <br> Procedimiento</h3>
								<a href="mostrar_procedimientos_dataTable.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-pencil"></i></a>
								</div>

						</div>
				</div>
			</div><!--Fin carta de eliminar procedimiento-->
		</div><!--Fin fila para la carta de agregar motivo de consulta y procedimiento (y eliminar)-->

			<!--Fila para las cartas de agregar especie/raza (y eliminar)-->
			<div class="row mt-3" style="margin-left: 15px;">
			<!--Carta agregar especie-->
			<div class="col-md-3">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Agregar<br> Especie</h3>
								<a href="agregar_especie.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-paw"></i></a>
								</div>

						</div>
				</div>
			</div><!--Fin carta agregar especie-->
			
			<!--Carta eliminar especie-->
			<div class="col-md-3">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Eliminar<br> Especie</h3>
								<a href="eliminar_especie.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-cancel"></i></a>
								</div>

						</div>
				</div>
			</div><!--Fin carta eliminar especie-->

			<!--Carta agregar raza-->
			<div class="col-md-3">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Agregar<br> Raza</h3>
								<a href="agregar_raza.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-guidedog"></i></a>
								</div>

						</div>
				</div>
			</div><!--Fin carta agregar raza-->

			<!--Carta eliminar raza-->
			<div class="col-md-3">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Eliminar<br> Raza</h3>
								<a href="eliminar_raza.php" class="pruebaBoton btn btn-block btn-lg"><i class="icon-cancel"></i></a>
								</div>

						</div>
				</div>
			</div><!--Fin carta eliminar raza-->
		</div><!--Fin fila para las cartas de agregar especie/raza (y eliminar)-->

		
				<br>
				<!--Fila para el contenido secundario-->
				<div id="secundario" class="row" style="margin-left: 15px;">
					<!--Columna para el contenido secundario-->
					<div class="col ">
						<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title"><bold>Consultas del dia de hoy</bold></h3>
								<p class="card-text">Hay <?php echo $total; ?> consultas para el dia de hoy</p>
								<!--Es decir antes de crear el boton para ver las citas del dia, primero reviso si total es diferente de cero, es decir si se encontraron citas para el dia de hoy creo el boton que me va a mandar a consultas_dia.php en donde voy a mostrar las consultas del dia, haciendo una consulta a la bd con la fecha actual que le estoy pasando por la url. De lo contrario, sino se encontraron citas para el dia de hoy entonces creo un boton que no mande a ninguna pagina y que diga, lo sentimos no hay citas para el dia de hoy-->
								<?php
									//SI HAY CITAS PARA EL DIA DE HOY
									if ($total != 0) {
								?>		
									<button  id="<?php echo $fechaActual; ?>" class="view_data pruebaBoton btn btn-block btn-lg">Ver consultas del dia</button>
					
								<?php
									//SINO HAY CITAS PARA EL DIA DE HOY
									}else{
									?>
									<a href="#" class="pruebaBoton btn btn-block btn-lg">No hay consultas para el dia de hoy!!</a>
								<?php
									}
								?>
								
								</div>
							</div>
					</div><!--Fin columna del contenido secundario-->
				</div><!--Fin fila del contenido secundario-->
				<br>
				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>

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

		<!-- Modal 2-->
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
					//Accedo al cuerpo del modal a traves de su id y le concanteno los resultados
					$('#mostrar').html(data);
					//Accedo al modal completo a traves de su id y lo muestro
					$('#dataModal').modal("show");

					$('.modal2').click(function(){
						//Guardo el id que tiene el boton del modal este id esta en consultas_dia.php (en este id tengo las observaciones)
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
<?php

		if (isset($_GET['registrado'])) {

			echo"
				<script>

				JSalertRegistro();

				</script>
			";
		}

			if (isset($_GET['registradoRaza'])) {

			echo"
				<script>

				JSalertRegistroRaza();

				</script>
			";
		}

		if (isset($_GET['registradoMotivo'])) {

			echo"
				<script>

				JSalertRegistroMotivo();

				</script>
			";
		}

		if (isset($_GET['registradoProcedimiento'])) {

			echo"
				<script>

				JSalertRegistroProcedimiento();

				</script>
			";
		}

		if (isset($_GET['razaEliminada'])) {

			echo"
				<script>

				JSalertEliminacionRaza()

				</script>
			";
		}

		if (isset($_GET['especieEliminada'])) {

			echo"
				<script>

				JSalertEliminacionEspecie()

				</script>
			";
		}
	?>
</body>
</html>