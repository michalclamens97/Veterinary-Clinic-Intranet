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
	<link rel="stylesheet" type="text/css" href="select_multiple/css/boostrap.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_pruebaFomularioCliente.css">
	
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
			margin-top: 40px;
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
		#ui #productos-error{
			font-size: 13px;
		}
		
		/*PARA AGRANDAR COLOCAR EL PLACEHOLDER  DEL SELECT PICKER CON LETRAS BLANCAS*/
		#ui .filter-option.pull-left{
			color: white;
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
					<h1 class="text-center">Formulario Desparacitacion</h1>
					<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" id="form_registro" class="form-group text-center">
						<!--Fila para el nombre, apellido y cedula-->
						<div class="row">
							<!--Hago un foreach con mis resultado del cliente que tengo en  formulario_vacunacion.php y muestro los valores en los inpust-->
							<?php foreach ($resultadoCliente as $dato): ?>
							<div class="col-md-4">
								<label for="nombre">Cliente:</label>
								<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $dato['NOMBRE'] .' ' .$dato['APELLIDO'];  ?>" disabled>
							</div>
							
							<div class="col-md-4">
								<label for="cedula">Cédula:</label>
								<input type="text" name="cedula" id="cedula" class="form-control" value="<?php echo $dato['CEDULA'];  ?>" disabled>
							</div>
							<?php endforeach ?> <!--Fin ciclo foreach de los resultados del cliente-->

							<div class="col-md-4">
								<label for="f_desparasitacion">Fecha Desparacitación</label>
								<input type="date" class="required form-control" value="<?php echo $fechaActual; ?>" title="Campo Obligatorio" name="f_desparasitacio" id="f_desparasitacio" disabled>
								<input type="hidden" class="required form-control" value="<?php echo $fechaActual; ?>" title="Campo Obligatorio" name="f_desparasitacion" id="f_desparasitacion">

							</div>
						
						</div><!--Fin fila del nombre, apellido y cedula-->
						<br>
						<!--Fila para mascotas, fecha desparasitacion y productos-->
						<div class="row">
							<div class="col-md-6">
								<label for="mascotas">Mascotas:</label>
								<select class="required form-control" title="Selecciona una Mascota" name="mascota">
									<option selected disabled>Mascotas</option>
									<!--Por cada mascota que tenga el cliente hago un option con el nombre de esa mascota, en el value le paso el id de la mascota ya que ese id lo necesito en formulario_vacunacion.php-->
									<?php foreach ($resultadoMascota as $dato): ?>
										<option class="one" value="<?php echo $dato['ID'] ?>"><?php echo ucfirst($dato['NOMBRE']) .' - '. $dato['RAZA'] .' - '. ucfirst($dato['SEXO']) .' - '. $dato["PESO"] ;?></option>
									<?php endforeach ?> <!--Fin foreach de los resultas de las mascotas-->
								</select>
							</div>
							
						

							<div class="col-md-6">
								<label for="productos">Productos</label>
								<select name="opciones" id="productos" class="required form-control selectpicker" data-live-search="true" multiple multiple title="Selecciona una Opción" data-actions-box="true" data-select-All-Text="Seleccionar todo" data-deselect-All-Text="Deseleccionar" data-live-Search-Placeholder="Busca algo..." data-none-Results-Text="No se encontro nada">
								<?php foreach ($resultadoProducto as $dato): ?>
								<option value="<?php echo $dato['PRODUCTO'] .', Lote:'. $dato['LOTE'] .', Elaboracion:' . $dato['ELABORACION'] .', Vencimiento:' .$dato['VENCIMIENTO'] ; ?>"><?php echo $dato['PRODUCTO']; ?></option>



								<?php endforeach ?>
								</select>
							</div>
							<!--Las opciones del select se van a ir guarando aqui, es decir este es el que voy a obtener en php-->
							<input type="hidden" name="productos" id="productos_hidden" />
						</div><!--Fin Fila para las mascotas, fecha aplicacion y fecha proxima-->
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
			
			<!--Columna de relleno-->
			<div class="col-md-2"></div>
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->

<script type="text/javascript" src="select_multiple/js/jquery.js"></script>
<!--PLUGIN PARA LAS VALIDACIONES (DEBE IR DEBAJO DE jquery)-->
<script type="text/javascript" src="jqueryValidate/validate.js"></script>
<script type="text/javascript" src="select_multiple/js/boostrap.js"></script>
<link rel="stylesheet" type="text/css" href="select_multiple/css/selecpickercs.css">
<script type="text/javascript" src="select_multiple/js/selectpicker.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<script>

$(document).ready(function(){



//LLamo a mi select el cual tiene la clase de selectpicker y le agrego la funcion selectpicker(el plugin)
 $('.selectpicker').selectpicker();
//Le agrego un evento de tipo change al select que tiene los frameworks para que cada ves que se seleccione una opcion me la guarde en mi input que cree de tipo hidden, esto me lo guarda en su atributo val
 $('#productos').change(function(){
  $('#productos_hidden').val($('#productos').val());
 });


//PARA CAMBIAR LOS BORDES DEL SELECTPICKER
$('#guardar').click(function(){

var titulo = $('.btn.dropdown-toggle.btn-default').attr('title');
	
	if (titulo == 'Selecciona una Opción') {

	$('.btn.dropdown-toggle.btn-default').css("border","2px solid #FF0000");

}else{

	$('.btn.dropdown-toggle.btn-default').css("border","2px solid #3498db");
}


});

//PARA QUE SE PONGA EN AZUL EL BORDE SI SE ESCOGE UNA OPCION Y SE ESCONDA EL MENSAJE DE ERROR
$('#productos').change(function(){

var titulo = $('.btn.dropdown-toggle.btn-default').attr('title');
	
	if (titulo != 'Selecciona una Opción') {


	$('.btn.dropdown-toggle.btn-default').css("border","2px solid #3498db");

	$('#productos-error').hide();

}


});
 
});
</script>


<!--VALIDACIONES-->
<script type="text/javascript" src="js/formulario_consulta_validate.js"></script>
</body>
</html>


