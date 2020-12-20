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
	<link rel="stylesheet" type="text/css" href="css/fontello_database.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<script type="text/javascript" src="js/sweetalert.js"></script><!--PLUGIN DE LA NOTIFICACION-->
	<script type="text/javascript">
			function JSalert(){
				swal("ERROR!", ", Ya ese procedimiento esta registrado!", "warning");
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
		select.error,input.error{
			border: 2px solid #FF0000;
		}		
			
		.error{
			color: black;
		}
	
	</style>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			
			<?php require'views/HeadTipo1.php'; ?>

				<!--Columna para el contenido principal(para las cartas)-->
			<main class="main col-md-9">
				<button class="wrapper btn" ><span><i class="icon-user"></i></span><?php echo " " .$_SESSION['usuario'] ."  "?><span><i class="icon-calendar"></i></span><?php echo " " .$fechaActual?></button>
			<!--Fila para las cartas-->
			<div class="row mt-1 justify-content-center">
			
			<!--Carta agregar procedimientos-->
			<div class="col-md-6">
				<div class="card">
					<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title">Agregar <br> Procedimiento</h3>
									<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="form_registro" method="POST">
											<label>Procedimientos Actuales:</label><br>
											<select class="form-control">
												<option value="procedimientos" selected disabled>Procedimientos...</option>
												<?php foreach ($resultado as $dato): ?>
												<option value="<?php echo $dato['PROCEDIMIENTO']; ?>" disabled><?php echo ucwords($dato['PROCEDIMIENTO']); ?></option>
												<?php endforeach ?>
											</select>
											<br>
											<label for="procedimiento">Ingrese Nuevo Procedimiento:</label>
											<input type="text" name="procedimiento" id="procedimiento" class="required form-control"  title="Campo Obligatorio" placeholder="Procedimiento...">
											<br>
											<label for="precio">Precio Procedimiento:</label>
											<input type="text" name="precio" id="precio" class="form-control required" title="Campo Obligatorio" placeholder="Precio procedimiento...">
											<br>
											<button type="submit" class="pruebaBoton btn btn-block btn-lg mb-1">Agregar Procedimiento</button>
										</form>
								</div>

						</div>
				</div>
			</div><!--Fin carta agregar procediminetos-->
		</div><!--Fin fila para las cartas-->

				
				<!--Fila para el contenido secundario-->
				<div id="secundario" class="row">
					<!--Columna para el contenido secundario-->
					<div class="col mt-1">
						<div class="prueba card card-inverse">
								<div class="card-block text-center">
								<h3 class="card-title"><bold>Consultas del día de hoy</bold></h3>
								<p class="card-text">Hay <?php echo $total; ?> consultas para el día de hoy</p>
								<!--Es decir antes de crear el boton para ver las citas del dia, primero reviso si total es diferente de cero, es decir si se encontraron citas para el dia de hoy creo el boton que me va a mandar a consultas_dia.php en donde voy a mostrar las consultas del dia, haciendo una consulta a la bd con la fecha actual que le estoy pasando por la url. De lo contrario, sino se encontraron citas para el dia de hoy entonces creo un boton que no mande a ninguna pagina y que diga, lo sentimos no hay citas para el dia de hoy-->
								<?php
									//SI HAY CITAS PARA EL DIA DE HOY
									if ($total != 0) {
								?>		
									<button  id="<?php echo $fechaActual; ?>" class="view_data pruebaBoton btn btn-block btn-lg">Ver consultas del día</button>
					
								<?php
									//SINO HAY CITAS PARA EL DIA DE HOY
									}else{
									?>
									<a href="#" class="pruebaBoton btn btn-block btn-lg">No hay consultas para el día de hoy!!</a>
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

</body>




<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="jqueryValidate/validate.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!--VALIDACIONES-->
<script type="text/javascript" src="js/formulario_consulta_validate.js"></script>

<?php

		if (isset($_GET['error'])) {

			echo"
				<script>

				JSalert();

				</script>
			";
		}

	?>
<!--MODAL-->
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

<!--VALIDACION SOLO LETRAS O NUMEROS-->
<script type="text/javascript" src="js/validaLetrasNumeros.js"></script>
 <script type="text/javascript">
            $(function(){
                //Para escribir solo letras
                $('#procedimiento').validCampoFranz(' abcdefghijklmnñopqrstuvwxyzáéíóú');       
            });
        </script>  
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
</html>
