<?php session_start();
	require 'admin/config.php';
	require 'functions.php';
	comprobarSession();
	
	$conexion = conexion($bd_config);
	if (!$conexion) {
		echo "ERROR";
	}
	
	$statement = $conexion->prepare("SELECT * FROM desparasitacion");
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
			"order": [[4, "desc"]],
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
							
							<th>Propietario</th>
							<th>Mascota</th>
							<th>Raza</th>
							<th>Especie</th>
							<th>Fecha</th>
							<th></th>
							
						</tr>
					</thead>
					
					<tbody>
						<!--Mientras tenga resultados los voy mostrando en mi tabla adjuntando a cada resultado su boton de editar y eliminar, a estos botones les paso por la url el id del resultado correspondiente, ya que para saber a que elemento voy a modificar o eliminar necesito ese id-->
						<?php foreach ($resultado as $row): ?>
							
							<tr>
								
								<td><?php echo $row['NOMBRE']; ?></td>
								<td><?php echo $row['MASCOTA']; ?></td>
								<td><?php echo $row['RAZA']; ?></td>
								<td><?php echo $row['ESPECIE']; ?></td>
								<td><?php echo $row['FECHA_CONSTANCIA']; ?></td>
								<td><a class="icon-bug" href="generar_constancia_desparasitacion.php?id=<?php echo $row['ID_MASCOTA'].'&cedula='.$row['CEDULA'].'&productos='.$row['PRODUCTOS'].'&fecha='.$row['FECHA_CONSTANCIA']; ?> " target="_blank"></a></td>
								
							</tr>
						<?php endforeach ?>

					</tbody>
				</table>
				<br>
				<br>
				<p style="text-align:center; margin-left: 20px;"><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita &reg; 2019</b></p>
			</div><!--Fin columna para la tabla-->
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->			
</body>

<script type="text/javascript" src="js/main.js"></script>
</html>