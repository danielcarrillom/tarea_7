<?php

//Conexión a la base de datos.
require_once('../bdd.php');

require_once('../validate_rut.php');

include('../sesion_full.php');

if (isset($_POST['form_funcionario'])) {

if ($_POST['nombre_funcionario'] == ''  or ! preg_match("/^[a-zA-Z ]{2,20}+$/", $_POST['nombre_funcionario'])) {

    echo "<script>alert('Error, el nombre ingresado no es correcto (solo letras de 2 a 20 caracteres)'); history.go(-1); </script>";

}else if ($_POST['apellidop_funcionario'] == '' or ! preg_match("/^[a-zA-Z ]{2,20}+$/", $_POST['apellidop_funcionario'])) {

    echo "<script>alert('Error, el apellido ingresado no es correcto (solo letras y mínimo de 2 a 20 caracteres)'); history.go(-1); </script>";

}else if ($_POST['apellidom_funcionario'] == '' or ! preg_match("/^[a-zA-Z ]{2,20}+$/", $_POST['apellidom_funcionario'])) {

    echo "<script>alert('Error, el apellido ingresado no es correcto (solo letras y mínimo de 2 a 20 caracteres)'); ; history.go(-1); </script>";

}else if ($_POST['telefono_funcionario'] == '' or ! preg_match("/^[0-9]{8}+$/", $_POST['telefono_funcionario'])) {

    echo "<script>alert('Error, el teléfono ingresado no es correcto (solo números de 8 caracteres)'); history.go(-1); </script>";

}else if ($_POST['nombre_hospital'] == '' or ! preg_match("/^[a-zA-Z ]{2,50}+$/", $_POST['nombre_hospital'])) {

    echo "<script>alert('Error, el hospital seleccionado no es correcto (mínimo de 2 a 50 caracteres)'); history.go(-1);  </script>";

}else if ($_POST['tipo_perfil'] == '' or ! preg_match("/^[a-zA-Z ]{4,15}+$/", $_POST['tipo_perfil'])) {

    echo "<script>alert('Error, el perfil seleccionado no es correcto (mínimo de 4 a 15 caracteres)'); history.go(-1); </script>";

}else{

	//Recibe ID y demás campos desde el formulario.
	$rut_funcionario   		= $_POST['rut_funcionario'];
	$nombre_funcionario		= $_POST['nombre_funcionario'];
	$apellidop_funcionario	= $_POST['apellidop_funcionario'];
	$apellidom_funcionario	= $_POST['apellidom_funcionario'];
	$telefono_funcionario	= $_POST['telefono_funcionario'];
	$perfil					= $_POST['tipo_perfil'];
	$hospital				= $_POST['nombre_hospital'];


	//Consulta y verifica que registro exista actualmente
	$select_funcionario = $bdd->prepare("SELECT rut_funcionario FROM funcionario WHERE rut_funcionario=?"); 
	$select_funcionario->execute(array($rut_funcionario));
	$count = $select_funcionario->rowCount();


	//A través del nombre hospital trae el ID de este.
	$select_hospital = $bdd->prepare("SELECT id_hospital, nombre_hospital FROM hospital WHERE nombre_hospital=?"); 
	$select_hospital->execute(array($hospital));
	$row_hospital = $select_hospital->fetch();

	$id_hospital = $row_hospital["id_hospital"];

	//Formatea rut para ser verificado
    $puntos=str_replace('.','',$rut_funcionario); 
    $separar= list($primero, $segundo) = explode("-",$puntos);

//Comprueba que rut sea correcto
if (validar_rut($primero, $segundo) == false) {

	echo "<script>alert('Error, Rut incorrecto.'); window.opener.location.reload(); window.close(); </script>";

//Si el funcionario a insertar existe, se envía una alerta pop up al usuario y se redirecciona a la lista de funcionarios.
}else if ($count == 1) {
	
	$update_funcionario = $bdd->prepare("UPDATE funcionario SET rut_funcionario=?, nombre_funcionario=?, apellidop_funcionario=?, apellidom_funcionario=?, telefono_funcionario=?, hospital_id_hospital=? WHERE rut_funcionario=?");
	$update_funcionario->execute(array($rut_funcionario, $nombre_funcionario, $apellidop_funcionario, $apellidom_funcionario, $telefono_funcionario, $id_hospital, $rut_funcionario));

	//Fecha actual
	date_default_timezone_set("Chile/Continental");
	$date_now 	    = date('Y-m-d H:i:s');

	//Tipo movimiento
	$tipo_movimiento 		= "Acción Update";
	$descripcion_movimiento = "Se modificó el funcionario con rut: ".$rut_funcionario;

	//Se inserta el movimiento del usuario la bitácora
	$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
	$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));

	echo "<script>alert('El funcionario se modificó correctamente!.'); window.opener.location.reload(); window.close();</script>";

}else{

	//De lo contrario muestra mensaje de error en pop up.
	echo "<script>alert('Error, ocurrió un problema al modificar el funcionario.'); window.opener.location.reload(); window.close();</script>";

}

}

}

?>