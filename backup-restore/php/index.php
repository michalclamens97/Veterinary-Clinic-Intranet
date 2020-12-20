<?php session_start();
require'../../admin/config.php';
require'../../functions.php';
comprobarSession();

if ($_SESSION['usuario'] != "admin"){
	header('location:../../index_usuario.php');
}
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
	<link rel="shortcut icon" href="../../img/logo2.png">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/fontello.css">
	<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
	<script type="text/javascript" src="../../js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../js/sweetalert.js"></script><!--PLUGIN DE LA NOTIFICACION-->

		<script type="text/javascript">
			function JSalertBackup(){
				swal("Exito!", "El respaldo se realizo exitosamente!", "success");
			}

			function JSalertRestore(){
				swal("Exito!", "La restauración se realizo exitosamente!", "success");
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
	<div class="container-fluid">
		<div class="row">
			<!--Columna para el menu-->
			<div class="barra-lateral col-md-2">
				<div class="logo text-center">
					<img style="height:220px;" src="../../img/logo3.png">
					
				</div>
				<!--Al colocar d-flex decimos que queremos usar flexbox, y al colocar d-sm-block es para que se ajuste el menu en dispositivos moviles. El justify-conten-center lo pongo para centrar el contenido. El flex-wrap lo pongo para que los enlaces se coloquen uno abajo del otro-->
					<nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
					<a href="../../index.php"><i class="icon-home"></i><span>Inicio</span></a>
					<a href="../../formulario_insertar_cliente.php"><i class="icon-user-add"></i><span>Insertar Cliente</span></a>
					<li><a href="#"><i class="icon-eye"></i><span>Mostrar</span></a>
						<ul class="sub">
							<li><a href="../../mostrar_consultas_dataTable.php"><i class="icon-th-thumb"></i><span>Consultas</span></a></li>
							<li><a href="../../mostrar_mascotas_dataTable.php"><i class="icon-guidedog"></i><span>Mascotas</span></a></li>
							<li><a href="../../mostrar_certificados_dataTable.php"><i class="icon-doc-text"></i><span>Cerficados Vacunación</span></a></li>
							<li><a href="../../mostrar_constancias_dataTable.php"><i class="icon-bug"></i><span>Constancia Parásitos</span></a></li>
							<li><a href="../../mostrar_informe_medico_dataTable.php"><i class="icon-ambulance"></i><span>Informe Médico</span></a></li>
						</ul>
					</li>

					<li><a href="#"><i class="icon-menu"></i><span>Paneles</span></a>
						<ul class="sub">
							<li><a href="../../mostrar_clientes_dataTable.php"><i class="icon-user"></i><span>Panel Clientes</span></a></li>
							<li><a href="../../index_panel_productos.php"><i class="icon-menu"></i><span>Panel Productos</span></a></li>
							<li><a href="../../index_panel_medicamentos.php"><i class="icon-hospital"></i><span>Panel Medicamentos</span></a></li>
							<li><a href="../../index_administracion.php"><i class="icon-doc-text"></i><span>Panel Administración</span></a></li>
							<li><a href="../../index_panel_general.php"><i class="icon-clipboard"></i><span>Panel General</span></a></li>
						</ul>
					</li>
					<a href="../../manuales/Manual de Usuario (Administrador).pdf" target="_blank"><i class="icon-clipboard"></i><span>Manual</span></a>
					<a href="../../cerrar.php"><i class="icon-logout"></i><span>Cerrar Sesión</span></a>

				</nav>			
				</div> <!--Fin columna del menu-->

				<!--Columna para el contenido principal(para las cartas)-->
			<main class="main col-md-9">
			<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>
			<!--Fila para las cartas-->
			<div class="row mt-5" style="margin-left: 15px;">
			<!--Carta insertar productos-->
			<div class="col-md-6">
				<div class="card">
					<div class="prueba card card-inverse ">
								<div class="card-block text-center">
								<h3 class="card-title">Realizar copia <br> de seguridad <br><br>
								<i class="icon-database"></i></h3>
								<p class="card-subtitle mb-3">Respaldar base de datos</p>
								<a href="./Backup.php" class="pruebaBoton btn btn-block btn-lg mb-1 "><i class="icon-floppy"></i></a>
								</div>

						</div>
				</div>
			</div><!--Fin carta insertar productos-->

			<!--Carta mostrar productos-->
			<div class="col-md-6">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Restaurar<br> Base de Datos</h3>
									<form action="./Restore.php" method="POST">
											<label>Selecciona un punto de restauración</label><br>
											<select name="restorePoint" class="form-control">
												<option value="" disabled="" selected="">Selecciona un punto de restauración</option>
												<?php
													include_once './Connet.php';
													$ruta=BACKUP_PATH;
													if(is_dir($ruta)){
				    									if($aux=opendir($ruta)){
				        									while(($archivo = readdir($aux)) !== false){
				            									if($archivo!="."&&$archivo!=".."){
				                									$nombrearchivo=str_replace(".sql", "", $archivo);
				                									$nombrearchivo=str_replace("-", ":", $nombrearchivo);
				                									$ruta_completa=$ruta.$archivo;
				                									if(is_dir($ruta_completa)){
				                									}else{
				                    									echo '<option value="'.$ruta_completa.'">'.$nombrearchivo.'</option>';
				                									}
				            									}
				        									}
				        									closedir($aux);
				    									}
													}else{
				    									echo $ruta." No es ruta válida";
													}
												?>
											</select>
											<br>
											<button type="submit" class="pruebaBoton btn btn-block btn-lg mb-1"><i class="icon-fast-backward"></i></button>
										</form>
								</div>

						</div>
				</div>
			</div><!--Fin carta mostrar productos-->
		</div><!--Fin fila para las cartas-->

				<br><br>
				<!--Fila para el contenido secundario-->
				<div id="secundario" class="row" style="margin-left: 15px;">
					<!--Columna para el contenido secundario-->
					<div class="col mt-2">
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
				<br>
				<p style="text-align:center;""><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>

			</main><!--Fin columna para el contenido principal-->
			
			<!--Columna de relleno-->
			<div class="col-md-1"></div><!--Fin columna de relleno-->

		</div><!--Fin fila principal-->
	</div>	<!--Fin contenedor principal-->
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
				url:"../../consultas_dia.php",
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


</body>


<script type="text/javascript" src="../../js/main.js"></script>
	<?php

		if (isset($_GET['finBackup'])) {

			echo"
				<script>

				JSalertBackup();

				</script>
			";
		}

		if (isset($_GET['restoreFin'])) {

			echo"
				<script>

				JSalertRestore();

				</script>
			";
		}
		
	?>
</html>
