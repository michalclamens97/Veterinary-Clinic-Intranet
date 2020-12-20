<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_formulario_cliente.css">
	<style type="text/css">
		.col > a{
			font-weight: bold;
			font-size: 20px;
		}

		
	</style>
	<title>Menu Principal</title>
</head>
<body>

	<!--Contenedor Principal-->
	<div class="container">
		<!--Fila principal-->
		<div class="row">
			<!--Columna de relleno-->
			<div class="col-md-2"></div>
			<!--Columna principal de mi formulario-->
			<div class="col-md-8">
				<!--Contenedor para darle estilos al formulario-->
				<div id="ui">
					<h1 class="text-center">Menu Principal</h1>
					<br>
					<form class="form-group text-center">
						<!--Filas con cada boton-->
						
						<div class="row">
							<div class="col">
								<a href="insertar_productos.php" class="btn btn-primary btn-block">Insertar Productos</a>
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col">
								<a href="resultado_mostrar_productos.php" class="btn btn-primary btn-block">Ver Productos</a>
							</div>
						</div>						
					</form><!--Fin formulario-->
				</div><!--Fin del contendor para dar los estilos-->
			</div><!--Fin de la columna principal la cual tiene todo el formulario-->
			
			<!--Columna de relleno-->
			<div class="col-md-2"></div>
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>