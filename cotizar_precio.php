<?php session_start();
require'admin/config.php';
require'functions.php';
comprobarSession();
//comprobarUsuario();
$conexion = conexion($bd_config);
if (!$conexion) {
	echo "ERROR";
}
//Obtengo los datos que pase por ajax (precio de la consulta y los procedimientos y los medicamentos)
$datos = $_POST['id'];

//Separo el precio de la consulta y los procedimientos y los medicamentos(ya yo se que entre el precio y los procedmientos y los medicamentos hay un / de por medio)
list($precio, $procedimientos, $medicamentos) = explode("/",$datos); 

//Como yo se que entre cada procedimiento hay una coma entonces lo que hago es separarlos y guardarlos en un arreglo
$array_procedimientos = explode(",",$procedimientos);

//Como yo se que entre cada medicamento hay una coma entonces lo que hago es separarlos y guardarlos en un arreglo
$array_medicamentos = explode(",",$medicamentos);

$precio_final = "<i class='icon-circle'></i><b>Precio Base:</b> " . $precio;

//Hago un foreach en donde por cada procedimiento que tengo en mi array procedimientos hago una consulta a la base de datos para obtener su precio, luego de cada consulta la ejecuto y voy guardando estos precios en otro arreglo al cual llame resultados
foreach ($array_procedimientos as $procedimiento) {
	$statement= $conexion->prepare('SELECT PRECIO FROM procedimientos_consulta WHERE PROCEDIMIENTO = :procedimiento');
	$statement->execute(array(

	':procedimiento' => $procedimiento

	));
$resultados[] = $statement->fetch();
}

//Hago un foreach en donde hago otra consulta para obtener el nombre del procedimiento y el precio y en cada vuelta guardo la info en un arreglo llamado informacion
foreach ($array_procedimientos as $procedimiento) {
	$statement= $conexion->prepare('SELECT * FROM procedimientos_consulta WHERE PROCEDIMIENTO = :procedimiento');
	$statement->execute(array(

	':procedimiento' => $procedimiento

	));
$informacion[] = $statement->fetch();
}
//Hago un foreach en el que voy concatenando en la variable info todos ls nombres y precios de los procedimientos
$info = "<i class='icon-hospital'></i><b>Procedimientos:</b> <br>";
foreach ($informacion as $dato) {
	
	$info .= "<i class='icon-pin'></i> " . $dato['PROCEDIMIENTO']. " - Precio: " .$dato['PRECIO'] ."</br>";
}



// Hago un ciclo for y recorro todos los resultados(precios) y les voy quitando las letras bs.
for ($i=0; $i < count($resultados) ; $i++) { 
	
	$resultados[$i] = str_replace("Bs.", "", $resultados[$i]);

}

$prueba = 0 ;

//Hago un foreach con los resultados (precios) y los voy sumando y guardando en una variable llamada prueba
foreach ($resultados as $dato) {
	
	$prueba =  $prueba + $dato['PRECIO'];
}


//Le quito al precio de la consulta los bs.
$precio = str_replace("Bs.", "", $precio);

//almaceno el precio total de los procedimientos en esta variable, el number_format es para ponerle decimales
$total_procedimientos = "<i class='icon-circle'></i><b>Total Procedimientos:</b> Bs. " . number_format($prueba,3);

//////////////////////////////LO MISMO PERO PARA LOS MEDICAMENTOS///////////////////////////////////////////////////
//Hago un foreach en donde por cada procedimiento que tengo en mi array procedimientos hago una consulta a la base de datos para obtener su precio, luego de cada consulta la ejecuto y voy guardando estos precios en otro arreglo al cual llame resultados
foreach ($array_medicamentos as $medicamento) {
	$statement= $conexion->prepare('SELECT PRECIO FROM medicamentos WHERE NOMBRE = :medicamento');
	$statement->execute(array(

	':medicamento' => $medicamento

	));
$resultados_medicamentos[] = $statement->fetch();
}

//Hago un foreach en donde hago otra consulta para obtener el nombre del procedimiento y el precio y en cada vuelta guardo la info en un arreglo llamado informacion
foreach ($array_medicamentos as $medicamento) {
	$statement= $conexion->prepare('SELECT * FROM medicamentos WHERE NOMBRE = :medicamento');
	$statement->execute(array(

	':medicamento' => $medicamento

	));
$informacion_medicamentos[] = $statement->fetch();
}
//Hago un foreach en el que voy concatenando en la variable info todos ls nombres y precios de los procedimientos
$info .= "</br><i class='icon-medkit'></i><b>Medicamentos:</b></br>";
foreach ($informacion_medicamentos as $dato) {
	
	$info.= "<i class='icon-pin'></i> " . $dato['NOMBRE']. " - Precio: " .$dato['PRECIO'] ."</br>";
}



// Hago un ciclo for y recorro todos los resultados(precios) y les voy quitando las letras bs.
for ($i=0; $i < count($resultados_medicamentos) ; $i++) { 
	
	$resultados_medicamentos[$i] = str_replace("Bs.", "", $resultados_medicamentos[$i]);

}

$prueba_medicamentos = 0 ;

//Hago un foreach con los resultados (precios) y los voy sumando y guardando en una variable llamada prueba
foreach ($resultados_medicamentos as $dato) {
	
	$prueba_medicamentos =  $prueba_medicamentos + $dato['PRECIO'];
}




//almaceno el precio total de los procedimientos en esta variable, el number_format es para ponerle decimales
$total_medicamentos = "<i class='icon-circle'></i><b>Total Medicamentos:</b> Bs. " . number_format($prueba_medicamentos,3);

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//calculo el precio final, sumando el precio de la consulta mas el precio de los procedimientos
$precio_total= $precio + $prueba + $prueba_medicamentos;

//Muestro el resultado final
echo $info .'<br>'. $total_procedimientos .'<br>'. $total_medicamentos .'<br>'. $precio_final .'<br><br><b><i class="icon-wallet"></i> Precio Total:</b> Bs. '. number_format($precio_total,3);



//echo print_r($resultados, true);

//echo json_encode($resultados);
//print_r($array_procedimientos);
 ?>