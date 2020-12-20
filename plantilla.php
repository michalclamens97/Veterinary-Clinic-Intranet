<?php 
require'fpdf/fpdf.php';
//Creamos una clase llamada pdf la cual va a heredar(extends) todas la funcionalidad de la libreria FPDF
class PDF extends FPDF{
	//Funcion para el header del reporte (DEBEMOS LLAMARLA ASI PARA QUE FPDF LA RECONOSCA COMO HEADER)
	function Header(){
		//En lugar de crear un variable, usamos $this ya que toda esta clase ya esta heredando el plugin fpdf, por lo que al colocar $this lo que estamos haciendo es referencia a esta clase, es decir con $this hacemos referencia directamente a la funcion que queremos usar de la clase.

	
		
		$this->SetFont('Arial','B',15);
		$this->Cell(120,10,'CLIVEMAS. C.A / V-05886848-1',0,0,'L');
		$this->SetFont('Arial','',12);
		$this->Ln(6);
		$this->Cell(120,10,'AV.PRINCIPAL SAN LORENZO SAN LORENZO() NVA ESPARTA',0,0,'L');
		$this->Ln(6);
		$this->Cell(120,10,'Tel:0295 2625655 0414-789-1652 Fax:0295 2625655',0,0,'L');
		$this->Ln(6);
		$this->Cell(120,10,'e-mail:lmascota@cantv.net',0,0,'L');
		$this->Ln(6);
		$this->Cell(120,10,'Responsable: Doctor Alfredo Puchi',0,0,'L');
		$this->Ln(10);
		$this->Line(10, 45, 210-20, 45);
		$this->Ln(6);


	}
}
 ?>