<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos_formulario_cliente.css">
	<title>Formulario buscar Cliente</title>
</head>
<body>

	<!--Contenedor Principal-->
	<div class="container">
		<!--Fila principal-->
		<div class="row">
			<!--Columna de relleno-->
			<div class="col-md-2"></div>
			<!--Columna principal-->
			<div class="col-md-8">
				<!--Contenedor para editar los estilos del formulario-->
				<div id="ui">
					<h1 class="text-center">Formulario Buscar Cliente</h1>
					<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"  class="form-group text-center">
						<!--Fila para el buscador del cliente-->
						<div class="row">
							<div class="col">
								<label for="cedula">Buscar Cliente:</label>
								<input type="text" name="cedula" id="cedula" class="form-control" placeholder="Cedula del cliente...">
							</div>
						</div><!--Fin fila buscador cliente-->
						<br>

						<!--Fila para el submit-->
						<div class="row">
							<div class="col">
								<input type="submit" name="guardar" id="guardar" class="btn btn-primary btn-block btn-lg" value="Guardar">
							</div>
						</div><!--Fin fila del submit-->
					</form><!--Fin formulario-->
				</div><!--Fin contenedor para editar los estilos del formulario-->
			</div><!--Fin columna principal-->

			<!--Columna de relleno-->
			<div class="col-md-2"></div>
		</div><!--Fin fila principal-->
	</div><!--Fin contenedor principal-->

<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>