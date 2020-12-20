<?php 


function conexion($bd_config){

		try {

			$conexion = new PDO('mysql:host=localhost;dbname='.$bd_config['basedatos'], $bd_config['usuario'], $bd_config['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			return $conexion;
	
			} catch (PDOException $e) {

				echo "ERROR: " .$e->getMessage();

			}
}


function limpiarDatos($datos){

	$datos = trim($datos);
	$datos = stripslashes($datos);
	$datos = htmlspecialchars($datos);
	return $datos;

}

//Funcion para calcular la edad de la mascota a partir de la fecha de nacimiento, esta funcion recibe como parametro la fecha de nacimiento de la mascota($edad_mascota)
function calcularEdad($edad_mascota){

	list($anio, $mes, $dia) = explode("-",$edad_mascota);
//Valores actuales
$diaActual=date("d");
$mesActual=date("m");
$anioActual=date("Y");

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
        if ($edad >= 1900)
        {
            $edad -= 1900;
        }


      
//echo $edad;

//calculo de los meses
 $meses=0;
        if($mesActual>$mes)
            $meses=$mesActual-$mes;
        if($mesActual<$mes)
            $meses=12-($mes-$mesActual);
        if($mesActual==$mes && $dia>$diaActual)
            $meses=11;
        //Regreso la edad y los meses en un array ya que quiero devolver estas dos variables
        return array($edad,$meses);
  //echo $meses; 
}

function comprobarSession(){
    //Si la sesion no esta setiada (para que este setiada tiene que iniciar sesion, esto lo asigno en login.php)
    if (!isset($_SESSION['usuario'])) {
        header('Location: login.php ');
    }



    
}


// Funcion para comprobar si el usuario que esta conectado es el administrador o no
function comprobarUsuario(){
   if ( $_SESSION['usuario']!="admin")
    {
        header('Location: index_usuario.php');
    }
}
 ?>