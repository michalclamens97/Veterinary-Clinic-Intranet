<?php session_start();
	require 'admin/config.php';
	require 'functions.php';
	comprobarSession();
	//comprobarUsuario();
	$conexion = conexion($bd_config);
	if (!$conexion) {
		echo "ERROR";
	}
	
	$statement = $conexion->prepare("SELECT * FROM informe_medico");
	$statement->execute();
	$resultado = $statement->fetchAll();
	
	//Obtengo la fecha actual
	$diaActual=date("d");
	$mesActual=date("m");
	$anioActual=date("Y");
	//Organizo la fecha en el formato que esta en la base de datos (yyyy/mm/dd)
	$fechaActual = $anioActual .'-'. $mesActual .'-'. $diaActual;
?>


<html lang="es">
	<head>
	<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<title>Clínica Veterinaria La Mascota</title>
		<link rel="shortcut icon" href="img/logo2.png">
		<link rel="stylesheet" type="text/css" href="data_table/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="data_table/css/bootstrap-theme.css">
		<link href="data_table/css/jquery.dataTables.min.css" rel="stylesheet">	
		<script type="text/javascript" src="data_table/js/jquery-3.1.1.min.js" ></script>
		<script type="text/javascript" src="data_table/js/bootstrap.min.js" ></script>
		<script src="data_table/js/jquery.dataTables.min.js"></script>
			<link rel="stylesheet" type="text/css" href="css/fontello.css">
			<link rel="stylesheet" type="text/css" href="css/estilos.css">
			<style type="text/css">
				.menu li{
					list-style: none;
				}

				.menu a{
					text-decoration: none;
				}

		   .wrapper {
  			margin: 1em;
  			margin-bottom: 0;
  			margin-top: 15px;
  			margin-left: 65%;
  			opacity: 0.9;
			background-color: #262a34;
  			cursor: pointer;
  			color: white;
		}

			.wrapper:hover {
  			background-color: #2ecc71;
  			color:black;
		}

			</style>

		<script>
	$(document).ready(function(){
		$('#mitabla').DataTable({
			"order": [[3, "desc"]],
			"language":{
				"lengthMenu": "Mostrar _MENU_ registros por página",
				"info": "Mostrando página _PAGE_ de _PAGES_",
				"infoEmpty": "No hay registros disponibles",
				"infoFiltered": "(filtrada de _MAX_ registros)",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search": "Buscar:",
				"zeroRecords":    "No se encontraron registros coincidentes",
				"paginate": {
					"next":       "Siguiente",
					"previous":   "Anterior"
				},					
			}
		});	
	});	
</script>

	</head>
	
<body>
	<div class="container-fluid">
			<!--Fila principal-->
			<div class="row">
				<?php require'views/HeadTipo1.php'; ?>
				
			<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>
			
			<br>
			<br>
			<br>

			<!--Columna para la tabla-->
			<div class="col-md-9 table-responsive">

				<table class="display" id="mitabla">
					<thead>
						<tr>
							
							<th>Cédula</th>
							<th>Mascota</th>
							
							<th>Fecha</th>
							<th>Informe</th>
							<th></th>
							
						</tr>
					</thead>
					
					<tbody>
						<!--Mientras tenga resultados los voy mostrando en mi tabla adjuntando a cada resultado su boton de editar y eliminar, a estos botones les paso por la url el id del resultado correspondiente, ya que para saber a que elemento voy a modificar o eliminar necesito ese id-->
						<?php foreach ($resultado as $row): ?>
							
							<tr>
								
								<td><?php echo $row['CEDULA_CLIENTE']; ?></td>
								<td><?php echo $row['NOMBRE_MASCOTA']; ?></td>
								
								<td><?php echo $row['FECHA_CITA']; ?></td>
								<td><?php echo $row['INFORME']; ?></td>
								
								<?php
									$statement_cliente = $conexion->prepare("SELECT * FROM cliente WHERE CEDULA = :ci");
									$statement_cliente->execute(array(':ci'=>$row['CEDULA_CLIENTE']));
									$resultado_cliente = $statement_cliente->fetchAll();

									 foreach ($resultado_cliente as $row_cliente):
								?>
								
								<?php
									$statement_mascota = $conexion->prepare("SELECT * FROM mascota WHERE ID = :id");
									$statement_mascota->execute(array(':id'=>$row['ID_MASCOTA']));
									$resultado_mascota = $statement_mascota->fetchAll();

									 foreach ($resultado_mascota as $row_mascota):


								?>
								<td><a class="icon-file-pdf" href="generar_informe_medico.php?cedula_cliente=<?php echo $row['CEDULA_CLIENTE'].'&id_mascota='.$row['ID_MASCOTA'].'&nombre_mascota='.$row['NOMBRE_MASCOTA'].'&motivo='.$row['MOTIVO'].'&procedimientos='.$row['PROCEDIMIENTOS'].'&observaciones='.$row['OBSERVACIONES'].'&fecha_cita='.$row['FECHA_CITA'].'&proxima_cita='.$row['PROXIMA_CITA'].'&precio='.$row['PRECIO'].'&medicamentos='.$row['MEDICAMENTOS'].'&informe='.$row['INFORME'].'&nombre_cliente='.$row_cliente['NOMBRE'].'&apellido_cliente='.$row_cliente['APELLIDO'].'&raza='.$row_mascota['RAZA'].'&especie='.$row_mascota['ESPECIE'].'&edad='.$row_mascota['EDAD'];?>" target="_blank"></a></td>							
							</tr>
								<?php endforeach ?>
							<?php endforeach ?>
						<?php endforeach ?>

					</tbody>
				</table>
				<br>
				<br>
				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>
			</div><!--Fin columna para la tabla-->
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->		

	<!-- Modal -->
		<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Observaciones</h4>
					</div>
					
					<div class="modal-body" id="mostrar">
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>	

	<!-- Modal2 -->
		<div class="modal fade" id="dataModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Tratamiento</h4>
					</div>
					
					<div class="modal-body" id="mostrar2">
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal3 - PRECIO -->
		<div class="modal fade" id="dataModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Precio Consulta</h4>
					</div>
					
					<div class="modal-body" id="mostrar3">
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>

</body>
<script type="text/javascript">
	$(document).ready(function(){
		//Accedo a traves de su clase view_Data al boton al que se le dio click
		$('.view_data').click(function(){
			//Guarddo el id que tiene el boton(este id tiene el id de la mascota y la fecha de la consulta)
			var id = $(this).attr("id");
			
			$.ajax({
				url:"observaciones.php",
				method:"post",
				data:{id:id},
				success:function(data){
					//Accedo al cuerpo del modal a traves de su id y le concanteno los resultados
					$('#mostrar').html(data);
					//Accedo al modal completo a traves de su id y lo muestro
					$('#dataModal').modal("show");

				}

			});

		});

			$('.view_data2').click(function(){
			//Guarddo el id que tiene el boton(este id tiene el id de la mascota y la fecha de la consulta)
			var id = $(this).attr("id");
			
			$.ajax({
				url:"tratamiento.php",
				method:"post",
				data:{id:id},
				success:function(data){
					//Accedo al cuerpo del modal a traves de su id y le concanteno los resultados
					$('#mostrar2').html(data);
					//Accedo al modal completo a traves de su id y lo muestro
					$('#dataModal2').modal("show");

				}

			});

		});

			$('.view_data_precio').click(function(){
			//Guarddo el id que tiene el boton(este id tiene el precio de la consulta y los tratamientos)
			var id = $(this).attr("id");
			
			$.ajax({
				url:"cotizar_precio.php",
				method:"post",
				data:{id:id},
				success:function(data){
					//Accedo al cuerpo del modal a traves de su id y le concanteno los resultados
					$('#mostrar3').html(data);
					//Accedo al modal completo a traves de su id y lo muestro
					$('#dataModal3').modal("show");

				}

			});

		});
	});
</script>
<script type="text/javascript" src="js/main.js"></script>
</html>