<?php 

//Agregamos la libreria 
require'PHPMailer/PHPMailerAutoload.php';

//Creamos un objeto de la libreria
$mail = new PHPMailer();
//Obtengo el pass que mande desde recuperar.php
$pass = $_GET['pass'];
//Obtengo el user que mande desde recuperar.php
$user = $_GET['user'];


//Asignamos el protocolo
$mail->isSMTP();
$mail->SMTPAuth = true;
//Asignamos los datos, estos datos varian de acuerdo al tipo de correo desde que vamos a enviar, en este caso estos son los datos que pide gmail
$mail->SMTSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = '587';
//Correo desde que voy a enviar y su pass
$mail->Username = 'conrad.clamens@gmail.com';
$mail->Password = 'mandyshop1';

//Colocamos el correo del que enviamos y un nombre o texto 
$mail->setFrom('conrad.clamens@gmail.com','Michael Clamens');

//Colocamos el correo al que queremos enviar, colocamos el correo de la persona y su nombre
$mail->addAddress('conrad.clamens@gmail.com','Prueba');

//Titulo del correo
$mail->Subject= 'Recuperar Clave - Veterinaria La Mascota (CLIVEMAS)' ;
//Agregamos el cuerpo del correo, puede ser html tambien
$mail->Body = "Veterinaria La Mascota <br> Dr. Alfredo Puchi <br> V-05886848-1 <br><br> Recuperar Clave <br><br> Su Nombre de Usuario es: " . $user . "<br> Su Clave es: " . $pass . "<br><br> <p style='text-align:center;'><b>Clínica Veterinaria La Mascota, Dr. Alfredo Puchi V-05886848-1 / (0295) 262.56.55 <br> Derechos Reservados Universidad de Margarita 2019</b></p>";
//Para habilitar el poder enviar contenido html
$mail->IsHTML(true);

//Para enviar un archivo
//$mail->addAttachment('ruta del archivo','nombre que le queramos poner');

//Verificamos si el correo se envio usando la funcion send()
if ($mail->send()) {
	header('Location:login.php?enviado');
}else{
	header('Location:login.php?errorCorreo');
}
 ?>
