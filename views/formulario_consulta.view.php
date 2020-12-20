<?php 


//Obtengo la fecha actual
$diaActual=date("d");
$mesActual=date("m");
$anioActual=date("Y");
//Organizo la fecha en el formato que esta en la base de datos (yyyy/mm/dd)
$fechaActual = $anioActual .'-'. $mesActual .'-'. $diaActual;

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Clínica Veterinaria La Mascota</title>
	<link rel="shortcut icon" href="img/logo2.png">
	<link rel="stylesheet" type="text/css" href="select_multiple/css/boostrap.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_formularioConsulta.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_pruebaFomularioCliente.css">
	
	<style type="text/css">
		*{
			font-family: Helvetica;
			font-size: 16px;
			line-height: 1.5;
			
		
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
			margin-top: 15px;
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
		/*Para que se muestren las opciones del select*/
		#ui option.one{
			color: black;
		}
		
		/*PARA AGRANDAR EL TAMANO DEL MENSAJE DE ERROR DEL SELECT PICKER*/
		#ui #procedimientos-error{
			font-size: 13px;
		}

		#ui #medicamentos-error{
			font-size: 13px;
		}
		/*PARA AGRANDAR COLOCAR EL PLACEHOLDER  DEL SELECT PICKER CON LETRAS BLANCAS*/
		#ui .filter-option.pull-left{
			color: white;
			font-size: 15px;
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

		#form_registro textarea.error{
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
					<h1 class="text-center">Formulario Consulta</h1>
					<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="form_registro" class="form-group text-center">
						<!--Fila para los datos del cliente y el select con las mascotas-->
						<div class="row">
							<!--Hago un foreach con mis resultado del cliente que tengo en  formulario_consulta.php y muestro los valores en los inpust-->
							<?php foreach ($resultadoCliente as $dato): ?>
							<div class="col-md-6">
								<label for="nombre">Datos Cliente:</label>
								<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $dato['NOMBRE'] .' '. $dato['APELLIDO'] .' CI: '. $dato['CEDULA'];?>" disabled>
							</div>
							
							<?php endforeach ?> <!--Fin ciclo foreach de los resultados del cliente-->
							<div class="col-md-6">
								<label for="mascotas">Mascotas:</label>
								<select class="form-control required" title="Selecciona una Opción" name="mascota">
									<option selected disabled>Mascotas</option>
									<!--Por cada mascota que tenga el cliente hago un option con el nombre de esa mascota, en el value le paso el id de la mascota ya que ese id lo voy a guardar en mi tabla consulta-->
									<?php foreach ($resultadoMascota as $dato): ?>
										<option class="one" value="<?php echo $dato['ID'] ?>"><?php echo ucfirst($dato['NOMBRE']) .' - '. $dato['RAZA'] .' - '. ucfirst($dato['SEXO']) .' - '. $dato["PESO"]; ?></option>
									<?php endforeach ?> <!--Fin foreach de los resultas de las mascotas-->
								</select>
							</div>
							
						</div><!--Fin fila del nombre,cedula,mascotas y boton de nueva mascota-->
						<br>
						<!--Fila agregar mascota, para el motivo de la consulta y los procedimientos-->
						<div class="row">
						<div class="col-md-4">
								<label>Agregar Mascota:</label>
								<!-- Hago otro foreach con los resultados del cliente donde Le paso al href del enlace la cedula del cliente que esta en la consulta, esto lo hago ya que necesito esa cedula crear una nueva mascota ya que asi es como relaciono a la mascota y al cliente. SIEMPRE PONER UN ENLACE Y NO UN BOTON, YA QUE CON EL BOTON NO FUNCIONA SIEMPRE-->
								<?php foreach ($resultadoCliente as $dato): ?>
								<a class="btn btn-danger btn-block" href="insertar_mascota.php?cedula=<?php echo $dato['CEDULA'];?>" target="_blank">Nueva Mascota</a>
								<?php endforeach; ?> <!--Fin del otro ciclo foreach que creo para pasarle la cedula del cliente por la url al archivo insertar_mascota.php-->
							</div>
							<div class="col-md-4">
								<label for="motivo">Motivo de la Consulta</label>
								<select class="form-control required" title="Selecciona una Opción" name="motivo">
									<option selected disabled>Motivo de la Consulta</option>
									<?php foreach ($resultadoMotivo as $dato): ?>
									<option class="one" value="<?php echo $dato['MOTIVO']; ?>"><?php echo ucwords($dato['MOTIVO']); ?></option>
									<?php endforeach ?>
								</select>					
							</div>

							<div class="col-md-4">
								<label for="motivo">Procedimientos</label>
								<select name="opciones" id="procedimientos" class="procedimientos required form-control selectpicker"  data-live-search="true" multiple multiple title="Selecciona una Opción" data-actions-box="true" data-select-All-Text="Seleccionar todo" data-deselect-All-Text="Deseleccionar" data-live-Search-Placeholder="Busca algo..." data-none-Results-Text="No se encontro nada">
									
									<?php foreach ($resultadoProcedimiento as $dato): ?>
									<option value="<?php echo $dato['PROCEDIMIENTO']; ?>"><?php echo $dato['PROCEDIMIENTO']; ?></option>
									<?php endforeach ?>

								</select>					
							</div>
							<!--Las opciones del select se van a ir guarando aqui, es decir este es el que voy a obtener en php-->
							<input type="hidden" name="procedimientos" id="procedimientos_hidden" />
						</div><!--Fin Fila para el motivo de la consulta y el tipo-->
						<br>

						<!--Fila para las observaciones-->
						<div class="row">
							<div class="col-md-12">
								<label for="observaciones">Observaciones:</label>
								<textarea class="form-control" style="max-height: 100px; max-width: 850px; min-width: 750px;" name="observaciones" id="observaciones" placeholder="Observaciones..."></textarea>
							</div>
						</div><!--Fin fila para las observaciones-->
						<br>

						<!--Fila para los medicamentos y tratamiento-->		
						<div class="row">
								<!--Columna para los medicamentos-->
								<div class="col-md-6">
										<label for="medicamentos">Medicamentos:</label>
										<select name="opciones2" id="medicamentos" class="medicamentos required form-control selectpicker" data-live-search="true" multiple multiple title="Selecciona una Opción" data-actions-box="true" data-select-All-Text="Seleccionar todo" data-deselect-All-Text="Deseleccionar" data-live-Search-Placeholder="Busca algo..." data-none-Results-Text="No se encontro nada" data-dropup-auto="false">
										<!--LO MAS SEGURO ES QUE TENGA QUE PASAR EL PRECIO TAMBIEN AQUI EN EL VALUE O TAMBIEN PUEDO HACER 		UNA CONSULTA CON EL NOMBRE DEL MEDICAMENTO PARA OBTENER SU PRECIO EN OTRO ARCHIVO-->
										<?php foreach ($resultadoMedicamentos as $dato): ?>
											<option value="<?php echo $dato['NOMBRE']; ?>"><?php echo $dato['NOMBRE']; ?></option>
									
										<?php endforeach ?>
										</select>
							<!--Las opciones del select se van a ir guarando aqui, es decir este es el que voy a obtener en php-->
										<input type="hidden" name="medicamentos" id="medicamentos_hidden" />
								</div><!--Fin columna medicamentos-->

								<!--Columna para el tratamiento-->
								<div class="col-md-6">
									<label for="tratamiento">Tratamiento:</label>
									<textarea class="form-control required" style="max-height: 100px; max-width: 360px; min-width: 360px; " name="tratamiento" id="tratamiento" placeholder="Tratamiento..." title="Campo Obligatorio"></textarea>
								</div><!--Fin columna tratamiento-->

						</div><!--Fin Fila para los medicamentos y tratamiento-->
						<br>
						<!--Fila la proxima cita,el precio de la consulta y la fecha actual-->
						<div class="row">
						<div class="col-md-4">
								<label for="fecha">Fecha Cita:</label>
								<input type="date" value="<?php echo $fechaActual; ?>"  name="fecha_cit" id="fecha_cit" class="form-control required" title="Campo Obligatorio" disabled>
								<input  type="hidden" value="<?php echo $fechaActual; ?>"  name="fecha_cita" id="fecha_cita" class="form-control required" title="Campo Obligatorio">
							</div>

							<div class="col-md-4">
								<label for="fecha">Próxima Cita:</label>
								<input type="date" name="proxima_cita" min="<?php echo $fechaActual; ?>" id="fecha_proxima" class="form-control " title="Fecha Incorrecta">
							</div>
							<div class="col-md-4">
								<label for="precio">Precio Consulta:</label>
								<input type="text" name="precio" id="precio" class="form-control required" title="Campo Obligatorio" placeholder="Precio de la consulta...">
							</div>
						</div><!--Fin fila de la proxima cita,precio y fecha actual-->
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

<script type="text/javascript" src="select_multiple/js/jquery.js"></script>
<!--PLUGIN PARA LAS VALIDACIONES (DEBE IR DEBAJO DE jquery)-->
<script type="text/javascript" src="jqueryValidate/validate.js"></script>
<script type="text/javascript" src="select_multiple/js/boostrap.js"></script>
<link rel="stylesheet" type="text/css" href="select_multiple/css/selecpickercs.css">
<script type="text/javascript" src="select_multiple/js/selectpicker.js"></script>
<script type="text/javascript" src="js/tratamiento_formularioConsulta.js"></script>
<script type="text/javascript" src="js/main.js"></script>





<script>

$(document).ready(function(){
//LLamo a mi select el cual tiene la clase de selectpicker y le agrego la funcion selectpicker(el plugin)
 $('.selectpicker').selectpicker();
//Le agrego un evento de tipo change al select que tiene los frameworks para que cada ves que se seleccione una opcion me la guarde en mi input que cree de tipo hidden, esto me lo guarda en su atributo val
 $('#procedimientos').change(function(){
  $('#procedimientos_hidden').val($('#procedimientos').val());
 });

 $('#medicamentos').change(function(){
  $('#medicamentos_hidden').val($('#medicamentos').val());
 });


////////////////////////////////////////////SELECTPICKER PROCEDIMIENTOS ESTILOS////////////////////////////////////////

 //PARA CAMBIAR LOS BORDES DEL SELECTPICKER DE PROCEDIMIENTOS
$('#guardar').click(function(){
//Al agregar un procedimiento se guarda en procedimientos_hidden, por eso si esta vacio significa que no se ingreso ningun procedimiento
var procedimientos = $('#procedimientos_hidden').val();

	if (procedimientos != "") {

		//TENGO QUE SELECCIONAR EL BOTON QUE ESTA DENTRO DEL DIV QUE SE CREA CON EL SELECTPICKER POR ESO USO FIND, EL PRIMERO ES EL DIV QUE SE CREA EL CUAL LE COLOQUE LA CLASE PROCEDIMIENTOS PARA DIFERENCIARLO, LUEGO CON LA FUNCION FIND ENCUENTRO EL BOTON AL QUE LE QUIERO DAR ESTILOS
		$('.btn-group.bootstrap-select.show-tick.procedimientos').find('.btn.dropdown-toggle.btn-default').css("border","2px solid #3498db");
	}else{
			$('.btn-group.bootstrap-select.show-tick.procedimientos').find('.btn.dropdown-toggle.btn-default').css("border","2px solid #FF0000");

	}


});
 //PARA CAMBIAR LOS BORDES DEL SELECTPICKER DE PROCEDIMIENTOS AL COLOR AZUL SI SE SELECCIONA UN PROCEDIMIENTO
$('#procedimientos').change(function(){
//Al agregar un procedimiento se guarda en procedimientos_hidden, por eso si esta vacio significa que no se ingreso ningun procedimiento
var procedimientos = $('#procedimientos_hidden').val();
	//SI ES DIFERENTE DE VACIO ES PORQUE SE AGREGO UN PROCEDIMIENTO POR LO QUE PROCEDO A COLOCAR EL BORDE EN AZUL Y A QUITAR EL MENSAJE DE ERROR
	if (procedimientos != "") {

		$('.btn-group.bootstrap-select.show-tick.procedimientos').find('.btn.dropdown-toggle.btn-default').css("border","2px solid #3498db");
		$('#procedimientos-error').hide();
	}


});

////////////////////////////////////////////SELECTPICKER MEDICAMENTOS ESTILOS////////////////////////////////////////
//PARA CAMBIAR LOS BORDES DEL SELECTPICKER DE MEDICAMENTOS
$('#guardar').click(function(){
//Al agregar un medicamento se guarda en procedimientos_hidden, por eso si esta vacio significa que no se ingreso ningun medicamento
var medicamentos = $('#medicamentos_hidden').val();

	if (medicamentos != "") {

		//TENGO QUE SELECCIONAR EL BOTON QUE ESTA DENTRO DEL DIV QUE SE CREA CON EL SELECTPICKER POR ESO USO FIND,  EL PRIMERO ES EL DIV QUE SE CREA EL CUAL LE COLOQUE LA CLASE MEDICAMENTOS PARA DIFERENCIARLO, LUEGO CON LA FUNCION FIND ENCUENTRO EL BOTON AL QUE LE QUIERO DAR ESTILOS
		$('.btn-group.bootstrap-select.show-tick.medicamentos').find('.btn.dropdown-toggle.btn-default').css("border","2px solid #3498db");
	}else{
			$('.btn-group.bootstrap-select.show-tick.medicamentos').find('.btn.dropdown-toggle.btn-default').css("border","2px solid #FF0000");

	}


});
 //PARA CAMBIAR LOS BORDES DEL SELECTPICKER DE MEDICAMENTOS AL COLOR AZUL SI SE SELECCIONA UN MEDICAMENTO
$('#medicamentos').change(function(){
//Al agregar un medicamento se guarda en medicamentos_hidden, por eso si esta vacio significa que no se ingreso ningun medicamento
var medicamentos = $('#medicamentos_hidden').val();
//SI ES DIFERENTE DE VACIO ES PORQUE SE AGREGO UN MEDICAMENTO POR LO QUE PROCEDO A COLOCAR EL BORDE EN AZUL Y A QUITAR EL MENSAJE DE ERROR
	if (medicamentos != "") {

		$('.btn-group.bootstrap-select.show-tick.medicamentos').find('.btn.dropdown-toggle.btn-default').css("border","2px solid #3498db");
		$('#medicamentos-error').hide();
	}


});

 
});


</script>
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
</body>
</html>