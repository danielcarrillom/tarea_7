<?php

//Conexión a la base de datos.
require_once('../bdd.php');

include('../sesion_full.php');

if (isset($_POST['form_perfil'])) {

if ($_POST['usuario'] == '' or ! preg_match("/^[a-z]{4,15}+$/", $_POST['usuario'])) {

    echo "<script>alert('Error!, el usuario ingresado no es correcto (solo letras minúsculas y mínimo de 4 a 15 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['contrasena'] == ''  or ! preg_match("/^[a-z0-9]{4,15}+$/", $_POST['contrasena'])) {

    echo "<script>alert('Error, la contraseña ingresada no es correcta (solo letras minúsculas, números y mínimo de 4 a 15 caracteres)');window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['tipo_perfil'] == '' or ! preg_match("/^[a-zA-Z]{4,7}+$/", $_POST['tipo_perfil'])) {

    echo "<script>alert('Error, el perfil seleccionado no es correcto (mínimo de 4 a 7 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else{

	//Recibe los campos del formulario y los guarda en una variable.
	$usuario_perfil	= $_POST['usuario'];
	$contraseña		= $_POST['contrasena'];
	$tipo_per		= $_POST['tipo_perfil'];

	//Consulta y verifica que registro no exista actualmente
	$select_perfil = $bdd->prepare("SELECT usuario FROM perfil WHERE usuario=?"); 
	$select_perfil->execute(array($usuario_perfil));
	$count = $select_perfil->rowCount();


//Si el perfil a insertar existe, se envía una alerta pop up al usuario y se redirecciona a la lista de perfiles.
if ($count == 1) {
	
	echo "<script>alert('Error, el perfil que intenta ingresar ya existe.'); window.opener.location.reload(); window.close(); </script>";

}else{

	$hash_password = password_hash($contraseña, PASSWORD_BCRYPT);

	//Fecha actual
	date_default_timezone_set("Chile/Continental");
	$date_now 	    = date('Y-m-d H:i:s');

	//Si no existe el perfil se inserta en tabla perfil.
	$insert_perfil = $bdd->prepare("INSERT INTO perfil (usuario, contraseña, tipo_perfil, fecha_creacion) VALUES (?,?,?,?)");
	$insert_perfil->execute(array($usuario_perfil, $hash_password, $tipo_per, $date_now));

	
	//Tipo movimiento
	$tipo_movimiento 		= "Acción Insert";
	$descripcion_movimiento = "Se agregó el perfil: ".$usuario_perfil;

	//Se inserta el movimiento del usuario la bitácora
	$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
	$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));

//Si el resultado es exitoso, muestra un mensaje en pop up.
if ($insert_perfil && $insert_bitacora) {
	
	echo "<script>alert('Perfil agregado con éxito.'); window.opener.location.reload(); window.close();</script>";

//Si ocurre un error, muestra un mensaje en pop up.
}else{

	echo "<script>alert('Error, ocurrió un problema al guardar el perfil.'); window.opener.location.reload(); window.close();</script>";
}

}		

}

}

?>