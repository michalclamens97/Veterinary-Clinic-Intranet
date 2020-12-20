<?php 
date_default_timezone_set('America/New_York');
//Valor a sacar la edad, lo separo con explode
$fecha = "1997-04-23"; 
list($anio, $mes, $dia) = explode("-",$fecha); 

//Valores actuales
$diaActual=date("d");
$mesActual=date("m");
$anioActual=date("Y");
$hora=date("H-i-s");
/*
//Calculo de la edad
 $edad = ($anioActual + 1900) - $anio;
        if ( $mesActual < $mes )
        {
            $edad--;
        }
        if (($mes == $mesActual) && ($diaActual < $dia))
        {
            $edad--;
        }
        if ($edad > 1900)
        {
            $edad -= 1900;
        }
echo $edad;

//calculo de los meses
 $meses=0;
        if($mesActual>$mes)
            $meses=$mesActual-$mes;
        if($mesActual<$mes)
            $meses=12-($mes-$mesActual);
        if($mesActual==$mes && $dia>$diaActual)
            $meses=11;
  echo $meses;

 */

 echo $diaActual .' ' . $mesActual . ' ' . $anioActual;  

 echo '<br>' . $hora;
?>