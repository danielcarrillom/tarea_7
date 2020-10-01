<?php

//Conexión a la base de datos.
require_once('../bdd.php');

include('../sesion_full.php');

if (isset($_POST['form_perfil'])) {

if ($_POST['usuario'] == '' or ! preg_match("/^[a-z]{4,15}+$/", $_POST['usuario'])) {

    echo "<script>alert('Error!, el usuario ingresado no es correcto (solo letras minúsculas y mínimo de 4 a 15 caracteres)'); history.go(-1); </script>";

}else if ($_POST['contrasena'] == ''  or ! preg_match("/^[a-z0-9]{4,15}+$/", $_POST['contrasena'])) {

    echo "<script>alert('Error, la contraseña ingresada no es correcta (solo letras  minúsculas, números y mínimo de 4 a 15 caracteres)'); history.go(-1); </script>";

}else if ($_POST['tipo_perfil'] == '' or ! preg_match("/^[a-zA-Z]{4,7}+$/", $_POST['tipo_perfil'])) {

    echo "<script>alert('Error, el perfil seleccionado no es correcto (mínimo de 4 a 7 caracteres)'); history.go(-1); </script>";

}else{

	//Recibe ID y demás campos desde el formulario.
	$id_perfil   	= intval($_POST['id_perfil']);
	$usuario_perfil	= $_POST['usuario'];
	$contraseña		= $_POST['contrasena'];
	$tipo_per		= $_POST['tipo_perfil'];
	$fecha_creacion = date("Y-m-d",strtotime($_POST['fecha_creacion']));



	$select_perfil = $bdd->prepare("SELECT id_perfil FROM perfil WHERE id_perfil=?"); 
	$select_perfil->execute(array($id_perfil));
	$count = $select_perfil->rowCount();


if ($count == 1) {

	$hash_password = password_hash($contraseña, PASSWORD_BCRYPT);
	
	$update_perfil = $bdd->prepare("UPDATE perfil SET usuario=?, contraseña=?, tipo_perfil=?, fecha_creacion=? WHERE id_perfil=?");
	$update_perfil->execute(array($usuario_perfil, $hash_password, $tipo_per, $fecha_creacion, $id_perfil));

	//Fecha actual
	date_default_timezone_set("Chile/Continental");
	$date_now 	    = date('Y-m-d H:i:s');
	
	//Tipo movimiento
	$tipo_movimiento 		= "Acción Update";
	$descripcion_movimiento = "Se modificó el perfil: ".$usuario_perfil;

	//Se inserta el movimiento del usuario la bitácora
	$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
	$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));

	echo "<script>alert('El perfil se modificó correctamente!.'); window.opener.location.reload(); window.close();</script>";

}else{

	//De lo contrario muestra mensaje de error en pop up.
	echo "<script>alert('Error, ocurrió un problema al modificar el perfil.'); window.opener.location.reload(); window.close();</script>";

}

}

}

?>