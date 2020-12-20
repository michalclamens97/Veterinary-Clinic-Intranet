<?php session_start();
require('admin/config.php');
require('functions.php');
comprobarSession();
$conexion = conexion($bd_config);
if (!$conexion) {
	echo "Error";
}
$salida = '';

$fecha_dia = $_POST['fecha_dia'];

  $statement = $conexion->prepare("SELECT * FROM consulta WHERE PROXIMA_CITA = :fecha ORDER BY FECHA_CITA DESC");
  $statement->execute(array(
    ':fecha' => $fecha_dia
    ));

   $resultado = $statement->fetchAll();

  $salida .= '
   <table class="table table-hover table-md">
     <thead class="thead-default">
              <th>Propietario</th>
              <th>Telefono</th>
              <th>Nombre</th>
              <th>Motivo</th>
              <th>Procedimientos</th>
              <th>Medicamentos</th>
              
              <th>Obs.</th>
              <th>Trat.</th>
              
              
    </thead>
 ';

 foreach ($resultado as $fila) {


  $statementCliente = $conexion->prepare("SELECT * FROM cliente WHERE CEDULA = :ci");
  $statementCliente->execute(array(
    ':ci' => $fila["CEDULA_CLIENTE"]
    ));

   $resultadoCliente = $statementCliente->fetchAll();

   foreach ($resultadoCliente as $filaCliente) {
  
$fila["OBSERVACIONES"] = wordwrap($fila["OBSERVACIONES"], 84, "\n", true);
$fila["TRATAMIENTO"] = str_replace(".", "<i class='icon-pin-outline'></i><br/>", $fila["TRATAMIENTO"]);

   $salida .= '
   <tr class="table-danger" >
    <td>'.$filaCliente["NOMBRE"].' ' .$filaCliente["APELLIDO"].' </td>
    <td>'.$filaCliente["TELEFONO"].'</td>
    <td>'.$fila["NOMBRE_MASCOTA"].'</td>
    <td>'.$fila["MOTIVO"].'</td>
    <td>'.$fila["PROCEDIMIENTOS"].'</td>
    <td>'.$fila["MEDICAMENTOS"].'</td>

  
    <td><button class="modal2 icon-clipboard"  id=" '.$fila["OBSERVACIONES"].'"></button></td>
    <td><button class="modal3 icon-stethoscope"  id=" '.$fila["TRATAMIENTO"].'"></button></td> 



   </tr>

  ';
}
 }

echo $salida;
 ?>
 