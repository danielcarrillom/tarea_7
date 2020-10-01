<?php

//Conexión a la base de datos.
require_once('../bdd.php');

require_once('../validate_rut.php');

include('../sesion_full.php');

if (isset($_POST['form_funcionario'])) {

if ($_POST['nombre_funcionario'] == ''  or ! preg_match("/^[a-zA-Z ]{2,20}+$/", $_POST['nombre_funcionario'])) {

    echo "<script>alert('Error, el nombre ingresado no es correcto (solo letras de 2 a 20 caracteres)'); window.opener.location.reload(); window.close();</script>";

}else if ($_POST['apellidop_funcionario'] == '' or ! preg_match("/^[a-zA-Z ]{2,20}+$/", $_POST['apellidop_funcionario'])) {

    echo "<script>alert('Error, el apellido paterno ingresado no es correcto (solo letras y mínimo de 2 a 20 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['apellidom_funcionario'] == '' or ! preg_match("/^[a-zA-Z ]{2,20}+$/", $_POST['apellidom_funcionario'])) {

    echo "<script>alert('Error, el apellido materno ingresado no es correcto (solo letras y mínimo de 2 a 20 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['telefono_funcionario'] == '' or ! preg_match("/^[0-9]{8}+$/", $_POST['telefono_funcionario'])) {

    echo "<script>alert('Error, el teléfono ingresado no es correcto (solo 8 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['nombre_hospital'] == '' or ! preg_match("/^[a-zA-Z ]{2,50}+$/", $_POST['nombre_hospital'])) {

    echo "<script>alert('Error, el hospital seleccionado no es correcto (mínimo de 2 a 50 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['tipo_perfil'] == '' or ! preg_match("/^[a-zA-Z ]{4,15}+$/", $_POST['tipo_perfil'])) {

    echo "<script>alert('Error, el perfil seleccionado no es correcto (mínimo de 4 a 15 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else{

	//Recibe los campos del formulario y los guarda en una variable.
	$rut_funcionario		= $_POST['rut_funcionario'];
	$nombre_funcionario		= $_POST['nombre_funcionario'];
	$apellidop_funcionario	= $_POST['apellidop_funcionario'];
	$apellidom_funcionario	= $_POST['apellidom_funcionario'];
	$telefono_funcionario	= $_POST['telefono_funcionario'];
	$nombre_hospital		= $_POST['nombre_hospital'];
	$tipo_perf				= $_POST['tipo_perfil'];


	//Consulta y verifica que registro no exista actualmente
	$select_funcionario = $bdd->prepare("SELECT rut_funcionario FROM funcionario WHERE rut_funcionario=?"); 
	$select_funcionario->execute(array($rut_funcionario));
	$count = $select_funcionario->rowCount();

	//Consulta el ID del hospital
	$select_hospital = $bdd->prepare("SELECT id_hospital, nombre_hospital FROM hospital WHERE nombre_hospital=?"); 
	$select_hospital->execute(array($nombre_hospital));
	$row_hospital = $select_hospital->fetch();

	$id_hospital = $row_hospital["id_hospital"];


	//Consulta el ID del tipo de perfil
	$select_perfil = $bdd->prepare("SELECT id_perfil, usuario  FROM perfil WHERE usuario=?"); 
	$select_perfil->execute(array($tipo_perf));
	$row_perfil = $select_perfil->fetch();

	$id_perfil = $row_perfil["id_perfil"];

	//Formatea rut para ser verificado
    $puntos=str_replace('.','',$rut_funcionario); 
    $separar= list($primero, $segundo) = explode("-",$puntos);

//Comprueba que rut sea correcto
if (validar_rut($primero, $segundo) == false) {

	echo "<script>alert('Error, Rut incorrecto.'); window.opener.location.reload(); window.close(); </script>";

//Si el funcionario a insertar existe, se envía una alerta pop up al usuario y se redirecciona a la lista de funcionarios.
}else if ($count == 1) {
	
	echo "<script>alert('Error, el funcionario que intenta ingresar ya existe.'); window.opener.location.reload(); window.close(); </script>";

}else{

	//Si no existe el funcionario se inserta en tabla funcionario.
	$insert_funcionario = $bdd->prepare("INSERT INTO funcionario (rut_funcionario, nombre_funcionario, apellidop_funcionario, apellidom_funcionario, telefono_funcionario, hospital_id_hospital, perfil_id_perfil) VALUES (?,?,?,?,?,?,?)");
	$insert_funcionario->execute(array($rut_funcionario, $nombre_funcionario, $apellidop_funcionario, $apellidom_funcionario, $telefono_funcionario, $id_hospital, $id_perfil));

	//Fecha actual
	date_default_timezone_set("Chile/Continental");
	$date_now 	    = date('Y-m-d H:i:s');

	//Tipo movimiento
	$tipo_movimiento 		= "Acción Insert";
	$descripcion_movimiento = "Se agregó el funcionario con rut: ".$rut_funcionario;

	//Se inserta el movimiento del usuario la bitácora
	$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
	$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));

//Si el resultado es exitoso, muestra un mensaje en pop up.
if ($insert_funcionario && $insert_bitacora) {
	
	echo "<script>alert('Funcionario agregado con éxito.'); window.opener.location.reload(); window.close();</script>";

//Si ocurre un error, muestra un mensaje en pop up.
}else{

	echo "<script>alert('Error, ocurrió un problema al guardar el funcionario.'); window.opener.location.reload(); window.close();</script>";
}

}		

}

}

?>