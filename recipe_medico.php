<?php session_start();
require('functions.php'); 
include'plantilla_recipe.php';

comprobarSession();
//comprobarUsuario();
$medicamentos = limpiarDatos($_GET['medicamentos']);
$tratamiento = limpiarDatos($_GET['tratamiento']);
//$id_mascota = limpiarDatos($_GET['id_mascota']);
$nombre_mascota = limpiarDatos($_GET['nombre_mascota']);
//$raza_mascota = limpiarDatos($_GET['raza']);
//$especie_mascota = limpiarDatos($_GET['especie']);
//$nombre_cliente = limpiarDatos($_GET['nombre_cliente']);
//$apellido_cliente = limpiarDatos($_GET['apellido_cliente']);
//$cedula_cliente = limpiarDatos($_GET['cedula_cliente']);
$fecha = limpiarDatos($_GET['fecha']);

//Para que se muestren uno abajo de otro
$medicamentos = str_replace(",", "\n", $medicamentos);
$tratamiento = str_replace("//", "\n", $tratamiento);

//Para que se muestren con un slash de separacion
//$medicamentos = str_replace(",", "/", $medicamentos)

//echo $medicamentos;


#Creo una variable a la cual le voy asignar la clase PDF que cree en plantilla.php, esta clase hereda todo el plugin de fpdf
$pdf = new PDF('L');

#Agrego una pagina
$pdf->AddPage();

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(120,10,utf8_decode('Recipe Médico'),0,0,'L');
$pdf->SetY($y);
$pdf->SetX($x+152);
$pdf->Cell(120,10,utf8_decode('Indicaciones'),0,0,'L');
$pdf->Ln(10);


#DATOS IZQUIERDA 1 RESULTADO
$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->SetFont('Arial','',12);
$pdf->multiCell(120,10,$medicamentos,0,'L',0);
$pdf->Ln(6);


#DATOS DERECHA 1 RESULTADO
$pdf->SetY($y);
$pdf->SetX($x+150);
$pdf->SetFont('Arial','',12);
$pdf->multiCell(120,10,$tratamiento,0,'L',0);
$pdf->Ln(6);



//////////////////////////////////PARA LA FECHA DE LA CONSULTA Y EL NOMBRE DE LA MASCOTA///////////////////////////////////////

//LAS COORDENADAS LAS OBTENGO MOSTRANDO "X" Y "Y" EN PLANTILLA_RECIPE.PHP, LUEGO AQUI LO QUE HAGO ES PROBAR

//Para la fecha del lado de recipe
$pdf->SetX(10);
$pdf->SetY(168);
$pdf->SetFont('Arial','',12);
$pdf->Cell(55,10,$fecha,0,0,'C');

//Para el nombre del lado de recipe
$pdf->SetX(10);
$pdf->SetY(177);
$pdf->SetFont('Arial','',12);
$pdf->Cell(44,10,$nombre_mascota,0,0,'C');

//Para la fecha del lado de tratamiento
$pdf->SetX(10+148);
$pdf->SetY(168);
$pdf->SetFont('Arial','',12);
$pdf->Cell(350,10,$fecha,0,0,'C');

//Para el nombre del lado de tratamiento
$pdf->SetX(10+148);
$pdf->SetY(177);
$pdf->SetFont('Arial','',12);
$pdf->Cell(340,10,$nombre_mascota,0,0,'C');

#SI QUEREMOS QUE EL REPORTE SE DESCARGUE AUTOMATICAMENTE COLOCAMOS DENTRO DE LOS PARENTESIS DEL Output() UNA 'D' (Output('D');)
$pdf->Output();


/*
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
$pdf->multiCell(100,8,$tratamiento,0,'L',0);
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

#DATOS DERECHA 2 TITULO
$pdf->SetY($y+12);
$pdf->SetX($x+100);
$pdf->SetFont('Arial','',10);
$pdf->Cell(120,10,'Medicamentos:',0,0,'L');
$pdf->Ln(6);
#DATOS DERECHA 2 RESULTADO
$pdf->SetY($y2+12);
$pdf->SetX($x2+100);
$pdf->SetFont('Arial','',12);
$pdf->multiCell(120,8,$medicamentos,0,'L',0);
$pdf->Ln(6);


*/
 ?>