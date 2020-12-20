<?php session_start();
require('admin/config.php');
require('functions.php');
comprobarSession();
$conexion = conexion($bd_config);
//Obtengo la especie que se selecciono en formulario_insertar_cliente, esta especie la mande por post en select_dinamico.js
$especie = $_POST['especie'];

$statement = $conexion->prepare('SELECT * FROM especies_raza WHERE TIPO = :tipo ORDER BY RAZA ASC ');
$statement->execute(array(':tipo' => $especie));

//Creo una variable en la cual voy a concatenar todos los options de la raza
$html = "<option value='raza' selected disabled>Raza</option>";
//Obtengo los resultados
$resultado = $statement->fetchAll();

//Recorro los resultados y en cada vuelta le concateno a la variable $html un option con una raza 
foreach ($resultado as $dato) {
	
	$html.= "<option class='one' value='".$dato['RAZA']."'>".$dato['RAZA']."</option>";
}

//Devuelvo los resultados a select_dinamico.js
echo $html;
 ?>