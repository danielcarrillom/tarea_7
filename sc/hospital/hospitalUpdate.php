<?php

//Conexión a la base de datos.
require_once('../bdd.php');

include('../sesion_full.php');

if (isset($_POST['form_hospital'])) {

if ($_POST['nombre_hospital'] == '' or ! preg_match("/^[a-zA-Z ]{2,50}+$/", $_POST['nombre_hospital'])) {

    echo "<script>alert('Error!, el nombre ingresado no es correcto (solo letras y mínimo de 2 a 50 caracteres)'); history.go(-1); </script>";

}else if ($_POST['direccion_hospital'] == ''  or ! preg_match("/^[a-zA-Z0-9 ]{2,50}+$/", $_POST['direccion_hospital'])) {

    echo "<script>alert('Error, la dirección ingresada no es correcta (solo letras, números y mínimo de 2 a 50 caracteres)'); history.go(-1); </script>";

}else if ($_POST['telefono_hospital'] == '' or ! preg_match("/^[0-9]{7}+$/", $_POST['telefono_hospital'])) {

    echo "<script>alert('Error, el teléfono ingresado no es correcto (solo números de 7 dígitos)'); history.go(-1); </script>";

}else{

	//Recibe ID y demás campos desde el formulario.
	$id_hospital   		= intval($_POST['id_hospital']);
	$nombre_hospital	= $_POST['nombre_hospital'];
	$direccion_hospital	= $_POST['direccion_hospital'];
	$telefono_hospital	= $_POST['telefono_hospital'];


	//Consulta y verifica que registro exista actualmente
	$select_hospital = $bdd->prepare("SELECT id_hospital FROM hospital WHERE id_hospital=?"); 
	$select_hospital->execute(array($id_hospital));
	$count = $select_hospital->rowCount();


//Si el hospital existe, se modifica y avisa al usuario.
if ($count == 1) {
	
	$update_hospital = $bdd->prepare("UPDATE hospital SET nombre_hospital=?, direccion_hospital=?, telefono_hospital=? WHERE id_hospital=?");
	$update_hospital->execute(array($nombre_hospital, $direccion_hospital, $telefono_hospital, $id_hospital));

	//Fecha actual
	date_default_timezone_set("Chile/Continental");
	$date_now 	    = date('Y-m-d H:i:s');
	
	//Tipo movimiento
	$tipo_movimiento 		= "Acción Update";
	$descripcion_movimiento = "Se modificó el hospital: ".$nombre_hospital;

	//Se inserta el movimiento del usuario la bitácora
	$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
	$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));

	echo "<script>alert('El hospital se modificó correctamente!.'); window.opener.location.reload(); window.close();</script>";

}else{

	//Mensaje de error en pop up.
	echo "<script>alert('Error, ocurrió un problema al modificar el hospital.'); window.opener.location.reload(); window.close();</script>";

}

}

}

?>