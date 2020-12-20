<?php session_start();
require'admin/config.php';
require('functions.php');
require('plantilla.php');
comprobarSession();

$conexion = conexion($bd_config);
if (!$conexion) {
echo "ERROR";
}
//Obtengo los datos que pase desde la url en mostrar_Certificados.php
$fecha_aplicacion = limpiarDatos($_GET['fecha_a']);  
$fecha_proxima = limpiarDatos($_GET['fecha_p']);
$item =  limpiarDatos($_GET['item']);
$cantidad = limpiarDatos($_GET['cantidad']);

#consulta para obtener todos los datos de la mascota, primero obtengo el id de la mascota que pase desde la url en mostrar_Certificados.php
$id_mascota = limpiarDatos($_GET['id_mascota']);
$statement = $conexion->prepare('SELECT * FROM mascota WHERE ID = :id');
$statement->execute(array(':id' => $id_mascota));
$resultadoMascota = $statement->FetchAll();

foreach ($resultadoMascota as $dato ) {
	
	$nombre_mascota =  $dato['NOMBRE'];
	$raza_mascota = $dato['RAZA'];
	$especie_mascota = $dato['ESPECIE'];
	$sexo_mascota = $dato['SEXO'];
	$edad_mascota = $dato['EDAD'];
	$cedula_cliente = $dato['CEDULA_CLIENTE'];
}

#Consulta para obtener los datos del cliente
$statement = $conexion->prepare('SELECT * FROM cliente WHERE CEDULA = :ci');
$statement->execute(array(':ci'=>$cedula_cliente));
$resultadoCliente = $statement->FetchAll();
foreach ($resultadoCliente as $dato ) {
	$nombre_cliente = $dato['NOMBRE'];
	$apellido_cliente = $dato['APELLIDO'];
	$direccion_cliente = $dato['DIRECCION'];
}

//LLamo a la funcion para calcular la edad de las mascota a partir de su fecha de nacimiento y le paso como parametro esta fecha, creo una lista con dos variebles a la cual le asigno esta funcion, esto lo hago ya que esta funcion me va a devolver dos valores, los cuales son la edad y los meses.
list($edad,$meses) = calcularEdad($edad_mascota);


//Validacion cuando la mascota tiene un 1
if ($meses == 1) {
	
	$meses = '1 mes';
}else{
	$meses = $meses .' meses';
}

if ($edad == 0) {
	$edad = '';
}else{
	$edad = $edad .' años';
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
#Creo una variable a la cual le voy asignar la clase PDF que cree en plantilla.php, esta clase hereda todo el plugin de fpdf
$pdf = new PDF();

#Agrego una pagina
$pdf->AddPage();


$pdf->SetFont('Arial','B',12);
$pdf->Cell(120,10,utf8_decode('Certificado de Vacunación'),0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 1 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Propietario:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 1 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$nombre_cliente .' '. $apellido_cliente,0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 1 TITULO
$pdf->SetY($y);
$pdf->SetX($x+100);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Paciente:',0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 1 RESULTADO
$pdf->SetY($y2);
$pdf->SetX($x2+100);
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$nombre_mascota,0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 2 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Cedula:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 2 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$cedula_cliente,0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 2 TITULO
$pdf->SetY($y);
$pdf->SetX($x+100);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Raza/Especie:',0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 2 RESULTADO
$pdf->SetY($y2);
$pdf->SetX($x2+100);
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$raza_mascota .'   ' . $especie_mascota,0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 3 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Localidad:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 3 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,utf8_decode($direccion_cliente),0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 3 TITULO
$pdf->SetY($y);
$pdf->SetX($x+100);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Sexo/Edad:',0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 3 RESULTADO
$pdf->SetY($y2);
$pdf->SetX($x2+100);
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,utf8_decode($sexo_mascota .'  ' . $edad .'  ' . $meses),0,0,'L');
$pdf->Ln(10);

#TITULOS DE LA SEMITABLA
$pdf->Line(10, 95, 210-20, 95);
$pdf->Ln(2);
$pdf->SetFont('Arial','B',11);
$x = $pdf->GetX();
$pdf->Cell(50,6,'Fecha de aplicacion',0,0,'L',0);
$x2 = $pdf->GetX();
$pdf->Cell(30,6,'Proxima',0,0,'L',0);
$x3 = $pdf->GetX();
$pdf->Cell(70,6,'Item',0,0,'L',0);
$x4 = $pdf->GetX();
$pdf->Cell(10,6,'Cantidad',0,1,'L',0);
$pdf->Ln(2);
$pdf->Line(10, 105, 210-20, 105);
$pdf->Ln(2);
#FIN TITULO DE LA SEMITABLA

#DATOS DE MI SEMITABLA (TODOS DEBERIAN VENIR DE LA BASE DE DATOS)
$pdf->SetFont('Arial','',11);
$pdf->SetX($x);
$pdf->Cell(50,6,$fecha_aplicacion,0,0,'L',0);
$pdf->SetX($x2);
$pdf->Cell(30,6,$fecha_proxima,0,0,'L',0);
$pdf->SetX($x3);
$pdf->Cell(70,6,$item,0,0,'L',0);
$pdf->SetX($x4);
$pdf->Cell(10,6,$cantidad,0,0,'L',0);


#SI QUEREMOS QUE EL REPORTE SE DESCARGUE AUTOMATICAMENTE COLOCAMOS DENTRO DE LOS PARENTESIS DEL Output() UNA 'D' (Output('D');)
$pdf->Output();


 ?>



 ?>