<?php session_start();
require('functions.php'); 
include'plantilla.php';
comprobarSession();

$motivo = limpiarDatos($_GET['motivo']);
$nombre_mascota = limpiarDatos($_GET['nombre_mascota']);
$cedula = limpiarDatos($_GET['cedula_cliente']);
$id_mascota = limpiarDatos($_GET['id_mascota']);
$proxima_cita = limpiarDatos($_GET['proxima_cita']);
$precio = limpiarDatos($_GET['precio']);
$observaciones = limpiarDatos($_GET['observaciones']);
$procedimientos = limpiarDatos($_GET['procedimientos']);
$informe  = limpiarDatos($_GET['informe']);
$nombre_cliente = limpiarDatos($_GET['nombre_cliente']);
$apellido_cliente = limpiarDatos($_GET['apellido_cliente']);
$raza = limpiarDatos($_GET['raza']);
$especie = limpiarDatos($_GET['especie']);
$edad_mascota = limpiarDatos($_GET['edad']);
$fecha_cita = limpiarDatos($_GET['fecha_cita']);
$medicamentos = $_GET['medicamentos'];

list($edad,$meses) = calcularEdad($edad_mascota);

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
$pdf->Cell(120,10,'Informe Medico',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 1 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Cedula cliente:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 1 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$cedula,0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 1 TITULO


#DATOS IZQUIERDA 2 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Nombre Cliente:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 2 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$nombre_cliente .' '. $apellido_cliente,0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 2 TITULO
$pdf->SetY($y);
$pdf->SetX($x+100);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Nombre Mascota:',0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 2 RESULTADO
$pdf->SetY($y2);
$pdf->SetX($x2+100);
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$nombre_mascota,0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 3 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Fecha Cita:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 3 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$fecha_cita,0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 3 TITULO
$pdf->SetY($y);
$pdf->SetX($x+100);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Proxima Cita:',0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 3 RESULTADO
$pdf->SetY($y2);
$pdf->SetX($x2+100);
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$proxima_cita,0,0,'L');
$pdf->Ln(6);


#DATOS IZQUIERDA 4 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Raza/Especie:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 4 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,$raza .' / '. $especie,0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 4 TITULO
$pdf->SetY($y);
$pdf->SetX($x+100);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'edad:',0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 4 RESULTADO
$pdf->SetY($y2);
$pdf->SetX($x2+100);
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,utf8_decode($edad .' '. $meses),0,0,'L');
$pdf->Ln(6);


#DATOS IZQUIERDA 5 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$x3 = $pdf->GetX();
$y3 = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Motivo:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 5 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$x4 = $pdf->GetX();
$y4 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->Cell(120,10,utf8_decode($motivo),0,0,'L');
$pdf->Ln(6);

#DATOS IZQUIERDA 6 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Observaciones:',0,0,'L');
$pdf->Ln(6);
#DATOS IZQUIERDA 6 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(100,8,utf8_decode($observaciones),0,'L',0); //multicell ya que como puede ser mucho texto se corra debajo del otro
$pdf->Ln(6);
#DATOS DERECHA 6 TITULO
$pdf->SetY($y3);
$pdf->SetX($x3+100);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Procedimientos:',0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 6 RESULTADO
$pdf->SetY($y4);
$pdf->SetX($x4+100);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(100,8,utf8_decode($procedimientos),0,'L',0);
$pdf->Ln(25);

#DATOS DERECHA 6 TITULO
$pdf->SetY($y3+12);
$pdf->SetX($x3+100);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Medicamentos:',0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 6 RESULTADO
$pdf->SetY($y4+12);
$pdf->SetX($x4+100);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(100,8,utf8_decode($medicamentos),0,'L',0);
$pdf->Ln(25);
//Para modificar la posicion de la linea son el segundo y ultimo valor(y1 y y2)
$pdf->Line(10, 155, 210-20, 155);
$pdf->Ln(5);




#DATOS IZQUIERDA 4 TITULO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Informe Medico:',0,0,'L');
$pdf->Ln(8);
#DATOS IZQUIERDA 4 RESULTADO
$x2 = $pdf->GetX();
$y2 = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(180,8,utf8_decode($informe),0,'L',0);

#SI QUEREMOS QUE EL REPORTE SE DESCARGUE AUTOMATICAMENTE COLOCAMOS DENTRO DE LOS PARENTESIS DEL Output() UNA 'D' (Output('D');)
$pdf->Output();


 ?>

