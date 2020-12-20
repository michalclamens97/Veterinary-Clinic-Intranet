<?php
session_start();


session_destroy();
//Para proteger el codigo
$_SESSION = array();

//Cuando cierra sesion hay que mandarlo al login de nuevo
header('Location: login.php');




?>