<?php session_start();
require('functions.php'); 
include'plantilla.php';
comprobarSession();
$nombre_cliente = limpiarDatos($_GET['nombre']);
$apellido_cliente = limpiarDatos($_GET['apellido']);
$cedula_cliente = limpiarDatos($_GET['cedula']);
$direccion_cliente = limpiarDatos($_GET['direccion']);
$telefono = limpiarDatos($_GET['telefono']);
$nombre_mascota = limpiarDatos($_GET['nombre_mascota']);
$raza_mascota = limpiarDatos($_GET['raza']);
$especie = limpiarDatos($_GET['especie']);
$sexo_mascota = limpiarDatos($_GET['sexo']);
$fecha_desparasitacion = limpiarDatos($_GET['fecha_d']);
$productos = limpiarDatos($_GET['productos']);
$edad_mascota = limpiarDatos($_GET['edad']);

//LLamo a la funcion para calcular la edad de las mascota a partir de su fecha de nacimiento y le paso como parametro esta fecha, creo una lista con dos variebles a la cual le asigno esta funcion, esto lo hago ya que esta funcion me va a devolver dos valores, los cuales son la edad y los meses.
list($edad,$meses) = calcularEdad($edad_mascota);

if ($especie == 'canina') {
	$especieConstancia = 'CANINO';
}

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
#Creo una variable a la cual le voy asignar la clase PDF que cree en plantilla.php, esta clase hereda todo el plugin de fpdf
$pdf = new PDF();

#Agrego una pagina
$pdf->AddPage();


$pdf->SetFont('Arial','B',12);
$pdf->Cell(120,10,"Constancia Desparasitacion - Fecha: $fecha_desparasitacion",0,0,"L");
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
$pdf->Cell(120,10,'Telefono:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 2 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$telefono,0,0,'L');
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
$pdf->Cell(120,10,$raza_mascota .'   ' . $especie,0,0,'L');
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
$pdf->Cell(120,10,$direccion_cliente,0,0,'L');
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
$pdf->Cell(120,10,utf8_decode($sexo_mascota .'  ' . $edad .' ' . $meses),0,0,'L');
$pdf->Ln(10);

$pdf->Line(10, 95, 210-20, 95);
$pdf->Ln(4);

#DATOS IZQUIERDA 4 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->MultiCell(180,5,"Por medio de la presente, hago constar, que el $especieConstancia, antes mencionado, ha sido Desparasitado contra Parasitos Internos y Externos con los productos: $productos",0,"L",0);
$pdf->Ln(8);



#SI QUEREMOS QUE EL REPORTE SE DESCARGUE AUTOMATICAMENTE COLOCAMOS DENTRO DE LOS PARENTESIS DEL Output() UNA 'D' (Output('D');)
$pdf->Output();


 ?>

