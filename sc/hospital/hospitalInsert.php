<?php

//Conexión a la base de datos.
require_once('../bdd.php');

include('../sesion_full.php');

if (isset($_POST['form_hospital'])) {

if ($_POST['nombre_hospital'] == '' or ! preg_match("/^[a-zA-Z ]{2,50}+$/", $_POST['nombre_hospital'])) {

    echo "<script>alert('Error!, el nombre ingresado no es correcto (solo letras y mínimo de 2 a 50 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['direccion_hospital'] == ''  or ! preg_match("/^[a-zA-Z0-9 ]{2,50}+$/", $_POST['direccion_hospital'])) {

    echo "<script>alert('Error, la dirección ingresada no es correcta (solo letras, números y mínimo de 2 a 50 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['telefono_hospital'] == '' or ! preg_match("/^[0-9]{7}+$/", $_POST['telefono_hospital'])) {

    echo "<script>alert('Error, el teléfono ingresado no es correcto (solo números de 7 dígitos)'); window.opener.location.reload(); window.close(); </script>";

}else{

	//Recibe los campos del formulario y los guarda en una variable.
	$nombre_hospital	= $_POST['nombre_hospital'];
	$direccion_hospital	= $_POST['direccion_hospital'];
	$telefono_hospital	= $_POST['telefono_hospital'];

	//Consulta y verifica que registro no exista actualmente
	$select_hospital = $bdd->prepare("SELECT nombre_hospital FROM hospital WHERE nombre_hospital=?"); 
	$select_hospital->execute(array($nombre_hospital));
	$count = $select_hospital->rowCount();


//Si el hospital a insertar existe, se envía una alerta pop up al usuario y se redirecciona a la lista de hospitales.
if ($count == 1) {
	
	echo "<script>alert('Error, el hospital que intenta ingresar ya existe.'); window.opener.location.reload(); window.close(); </script>";

}else{


	//Si no existe el hospital se inserta en tabla hospital.
	$insert_hospital = $bdd->prepare("INSERT INTO hospital (nombre_hospital, direccion_hospital, telefono_hospital) VALUES (?,?,?)");
	$insert_hospital->execute(array($nombre_hospital, $direccion_hospital, $telefono_hospital));

	//Fecha actual
	date_default_timezone_set("Chile/Continental");
	$date_now 	    = date('Y-m-d H:i:s');
	
	//Tipo movimiento
	$tipo_movimiento 		= "Acción Insert";
	$descripcion_movimiento = "Se agregó el hospital: ".$nombre_hospital;

	//Se inserta el movimiento del usuario la bitácora
	$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
	$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));

//Si el resultado es exitoso, muestra un mensaje en pop up.
if ($insert_hospital && $insert_bitacora) {
	
	echo "<script>alert('Hospital agregado con éxito.'); window.opener.location.reload(); window.close();</script>";

//Si ocurre un error, muestra un mensaje en pop up.
}else{

	echo "<script>alert('Error, ocurrió un problema al guardar el hospital.'); window.opener.location.reload(); window.close();</script>";
}

}	

}

}	

?>