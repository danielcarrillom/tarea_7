<?php
error_reporting(0);
//SE INICIA LA SESIÓN
session_start(); 

include('sc/bdd.php');

if (isset($_POST['submit'])) {

//RECIBE LOS CAMPOS DEL FORMULARIO
$username=$_POST['usuario'];
$password=$_POST['contraseña'];


//CONSULTA LOS CAMPOS RECIBIDOS EN LA BD
$select_perfil = $bdd->prepare("SELECT usuario, tipo_perfil, contraseña, fecha_creacion FROM perfil WHERE usuario =?");
$select_perfil->execute(array($username));
$count = $select_perfil->rowCount();

//GUARDA EN VARIABLE LA COINCIDENCIA ENCONTRADA
while ($row = $select_perfil->fetch()){

$usuario 		= $row['usuario'];
$contraseña 	= $row['contraseña'];
$tipo_perfil 	= $row['tipo_perfil'];
$fecha_registro = $row['fecha_creacion'];


//FORMATO FECHA/HORA CHILE
date_default_timezone_set("Chile/Continental");
$date_now 	   = date('Y-m-d');

//SE LE SUMA 30 DÍAS A LA FECHA ACTUAL
$perfil_calcula = strtotime($fecha_registro."+ 30 days");
$fecha_caduca = date("Y-m-d",$perfil_calcula);


//SE CARGAN LAS FECHAS EN VARIABLE
$fecha_inicio 	= new DateTime($date_now);
$fecha_fin 		= new DateTime($fecha_caduca);

//SE EXTRAE LA DIFERENCIA EN DÍAS
$diferencia = $fecha_inicio->diff($fecha_fin);

}

//COMPRUEBA QUE USUARIO SEA CORRECTO
if ($usuario == '') {

	echo"<script>alert('ERROR! USUARIO INCORRECTO.'); window.location.href=\"index.php\"</script>";

//COMPRUEBA QUE CONTRASEÑA SEA CORRECTA
}else if (!password_verify($password, $contraseña)) {

	echo"<script>alert('ERROR! CONTRASEÑA INCORRECTA.'); window.location.href=\"index.php\"</script>";

//SI EL USUARIO A LOGEARSE TIENE PERFIL ADMINISTRADORelse 
}else if ($count == 1 && $tipo_perfil == 'Full'  && $diferencia->days >= 0 && $date_now <= $fecha_caduca){

	//INICIA LA SESIÓN
	$_SESSION['login_full_sys']=$username; 

	//REDIRECCIONA A UNA PÁGINA DETERMINADA
	echo"<script type='text/javascript'> window.location='view_administrador.php'; </script>";	

//SI EL USUARIO A LOGEARSE TIENE PERFIL LIMITADO
} else if ($count == 1 && $tipo_perfil == 'Limited' && $diferencia->days >= 0 && $date_now <= $fecha_caduca){

	//INICIA LA SESIÓN
	$_SESSION['login_limited_sys']=$username; 

	//REDIRECCIONA A UNA PÁGINA DETERMINADA
	echo"<script type='text/javascript'> window.location='view_historial_clinico_ltd.php'; </script>";	

//SI YA PASARON 30 DÍAS DESDE QUE SE CREÓ EL PERFIL
}else if ($count == 1 && $diferencia->days > 0 && $date_now > $fecha_caduca){
	
	//MENSAJE INFORMANDO AL USUARIO
	echo"<script>alert('ERROR! SU CONTRASEÑA CADUCÓ, FAVOR CONTACTARSE CON EL ADMINISTRADOR DEL SISTEMA.'); window.location.href=\"index.php\"</script>";	

}

}

?>