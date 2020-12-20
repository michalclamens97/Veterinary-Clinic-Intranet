<?php 
require'fpdf/fpdf.php';
//Creamos una clase llamada pdf la cual va a heredar(extends) todas la funcionalidad de la libreria FPDF
class PDF extends FPDF{
	//Funcion para el header del reporte (DEBEMOS LLAMARLA ASI PARA QUE FPDF LA RECONOSCA COMO HEADER)
	function Header(){
		//En lugar de crear un variable, usamos $this ya que toda esta clase ya esta heredando el plugin fpdf, por lo que al colocar $this lo que estamos haciendo es referencia a esta clase, es decir con $this hacemos referencia directamente a la funcion que queremos usar de la clase.

	
		
		$this->SetFont('Arial','B',15);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(120,10,'Dr. Alfredo Puchi',0,0,'C');
		$this->Line(40, 18, 120-20, 18);
		$this->SetY($y);
		$this->SetX($x+160);
		$this->Cell(110,10,'Dr. Alfredo Puchi',0,0,'C');
		$this->Line(195, 18, 274-20, 18);
		$this->SetFont('Arial','',11);
		$this->Ln(6);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(120,10,utf8_decode('Médico Veterinario'),0,0,'C');
		$this->SetY($y);
		$this->SetX($x+160);
		$this->Cell(110,10,utf8_decode('Médico Veterinario'),0,0,'C');
		$this->SetFont('Arial','B',11);
		$this->Ln(6);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(120,10,'RIF.: V-05886848-1',0,0,'C');
		$this->SetY($y);
		$this->SetX($x+160);
		$this->Cell(110,10,'RIF.: V-05886848-1',0,0,'C');
		$this->SetFont('Arial','',10);
		$this->Ln(6);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(120,10,'Av. Principal de San Lorenzo a 300 mts del Sambil, Sector San Lorenzo',0,0,'C');
		$this->SetY($y);
		$this->SetX($x+160);
		$this->Cell(110,10,'Av. Principal de San Lorenzo a 300 mts del Sambil, Sector San Lorenzo',0,0,'C');
		$this->Ln(6);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(120,10,'Isla de Margarita - Telf.:(0295) 262.5655 - (0414) 789.1652 - (0416) 696.1652',0,0,'C');
		$this->SetY($y);
		$this->SetX($x+160);
		$this->Cell(110,10,'Isla de Margarita - Telf.:(0295) 262.5655 - (0414) 789.1652 - (0416) 696.1652',0,0,'C');
		$this->Ln(6);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(125,10,'veterinarialamascota@cantv.net - Horario: LUNES A SABADO de 08:00 am. a 05:00 pm.',0,0,'C');
		$this->SetY($y);
		$this->SetX($x+148);
		$this->Cell(135,10,'veterinarialamascota@cantv.net - Horario: LUNES A SABADO de 08:00 am. a 05:00 pm.',0,0,'C');
		$this->Ln(10);
		$this->Line(1, 50, 170-20, 50);
		$this->Ln(6);
		$this->Line(155, 50, 315-20, 50);


	}

		


	function Footer(){

		#Ubico el contenido 15 pixeles arriba del final de la pagina(al llamar a la funcion footer fpdf sabe que esto es el footer del reporte y me lo pone al final)
		$this->SetY(-60);
		#Establezco la fuente del footer
		$this->SetFont('Arial','I',14);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(120,10, 'Prevenga a su mascota contra',0,0,'C');
		$this->SetY($y);
		$this->SetX($x+148);
		$this->Cell(120,10, 'Prevenga a su mascota contra',0,0,'C');
		$this->Ln(6);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(120,10, utf8_decode('la enfermedad del Gusano de Corazón'),0,0,'C');
		$this->SetY($y);
		$this->SetX($x+148);
		$this->Cell(120,10, utf8_decode('la enfermedad del Gusano de Corazón'),0,0,'C');
		$this->Ln(12);
		$this->SetFont('Arial','',10);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(120,10,'Fecha:',0,0,'L');
		$this->SetY($y);
		$this->SetX($x+148);
		$this->Cell(120,10,'Fecha:',0,0,'L');
		$this->Line(23, 175, 100-20, 175);
		$this->Line(172, 175, 250-20, 175);
		$this->Ln(10);
		$x = $this->GetX();
		$y = $this->GetY();
		$this->Cell(120,10,'Nombre:',0,0,'L');
		$this->SetY($y);
		$this->SetX($x+148);
		$this->Cell(120,10,'Nombre:',0,0,'L');
		$this->Line(26, 185, 100-20, 185);
		$this->Line(174, 185, 250-20, 185);



	}
}
 ?>