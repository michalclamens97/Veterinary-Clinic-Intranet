<?php session_start();
require('admin/config.php');
require('functions.php');
comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
	echo "ERROR";
}

//Es decir si se mandaron los datos(si se le dio click al boton de actualizar) entonces actualizame los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST'){


		$id = limpiarDatos($_POST['id']); 
		$nombre = limpiarDatos($_POST['nombre']);
		$peso = limpiarDatos($_POST['peso']);
		$edad = limpiarDatos($_POST['fecha']);
		$especie = limpiarDatos($_POST['especie']);
		$raza = limpiarDatos($_POST['raza']);
		$sexo = limpiarDatos($_POST['sexo']);
		$est = limpiarDatos($_POST['est']);
		//La raza y especie que esta seleccionada antes de modificar se muestran en el select de manera disabled por lo que si no se modifica nada estos campos no tendrian ningun valor, es por ello que en el editar mascota.view lo que hago es tener dos inputs de tipo hidden con la raza y especie vieja, de manera que si el usuario no modifico ni la raza ni la especie es decir si esos valores estan vacios entonces le asigno los valores que tenia antes.
		$especie_vieja = limpiarDatos($_POST['especie_vieja']);
		$raza_vieja = limpiarDatos($_POST['raza_vieja']);
		$sexo_viejo = limpiarDatos($_POST['sexo_viejo']);
		$est_viejo = limpiarDatos($_POST['est_viejo']);
		if ($especie == ""){
			$especie = $especie_vieja;
		}

		if ($raza == "") {
			$raza = $raza_vieja;
		}

		if ($sexo == "") {
			$sexo = $sexo_viejo;
		}

		if ($est == "") {
			$est = $est_viejo;
		}


		$statement = $conexion->prepare("UPDATE mascota SET NOMBRE = :nombre, ESPECIE = :especie, RAZA = :raza, SEXO = :sex, ESTERILIZADO = :est, PESO = :peso, EDAD = :edad WHERE ID = :id");
		$statement->execute(array(
			':nombre' => $nombre,
			':especie' => $especie,
			':raza' => $raza,
			':sex' => $sexo,
			':est' => $est,
			':peso' => $peso,
			':edad' => $edad,
			':id' => $id

			));

		header('Location: mostrar_mascotas_dataTable.php?MascotaModificada');



	}else{//Sino se mandaron los datos, es decir si no se le ha dado click al boton de modificar entonces obtengo el id que mande desde mostrar mascotas y obtengo todos los datos de la mascota con ese, estos datos son los que muestro en los inputs de editar mascota. Es decir siempre va a entrar primero en este else y luego es que entra en el if. (SIEMPRE QUE SE VAYA A EDITAR ALGO HAY QUE HACERLO DE ESTA FORMA CON ESTE IF Y ELSE)
		$id = $_GET['id'];
		$statement = $conexion->prepare("SELECT * FROM mascota WHERE ID = :id");
		$statement->execute(array(':id'=>$id));
		$resultado = $statement->fetchAll();

		$statement_especies = $conexion->prepare('SELECT * FROM especies');
		$statement_especies->execute();
		$resultado_especies = $statement_especies->fetchAll();
	}



require('views/editar_mascota.view.php');

 ?>