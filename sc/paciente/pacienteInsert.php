<?php

//Conexión a la base de datos.
require_once('../bdd.php');

require_once('../validate_rut.php');

include('../sesion_full.php');

if (isset($_POST['form_paciente'])) {

if ($_POST['nombre_paciente'] == ''  or ! preg_match("/^[a-zA-Z ]{2,20}+$/", $_POST['nombre_paciente'])) {

    echo "<script>alert('Error, el nombre ingresado no es correcto (solo letras de 2 a 20 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['apellidom_paciente'] == '' or ! preg_match("/^[a-zA-Z ]{2,20}+$/", $_POST['apellidom_paciente'])) {

    echo "<script>alert('Error, el apellido materno ingresado no es correcto (solo letras y mínimo de 2 a 20 caracteres)'); ; window.location.href='../pacienteAdd.php'; </script>";

}else if ($_POST['apellidop_paciente'] == '' or ! preg_match("/^[a-zA-Z ]{2,20}+$/", $_POST['apellidop_paciente'])) {

    echo "<script>alert('Error, el apellido paterno ingresado no es correcto (solo letras y mínimo de 2 a 20 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['telefono_paciente'] == '' or ! preg_match("/^[0-9]{8}+$/", $_POST['telefono_paciente'])) {

    echo "<script>alert('Error, el teléfono ingresado no es correcto (solo 8 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['direccion_paciente'] == '' or ! preg_match("/^[a-zA-Z0-9 ]{2,50}+$/", $_POST['direccion_paciente'])) {

    echo "<script>alert('Error, la dirección ingresada no es correcta (solo letras y mínimo de 2 a 50 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else{

	//Recibe los campos del formulario y los guarda en una variable.
	$rut_paciente		= $_POST['rut_paciente'];
	$nombre_paciente	= $_POST['nombre_paciente'];
	$apellidop_paciente	= $_POST['apellidop_paciente'];
	$apellidom_paciente	= $_POST['apellidom_paciente'];
	$telefono_paciente	= $_POST['telefono_paciente'];
	$direccion_paciente	= $_POST['direccion_paciente'];


	//Consulta y verifica que registro no exista actualmente
	$select_paciente = $bdd->prepare("SELECT rut_paciente FROM paciente WHERE rut_paciente=?"); 
	$select_paciente->execute(array($rut_paciente));
	$count = $select_paciente->rowCount();

    //Formatea rut para ser verificado
    $puntos=str_replace('.','',$rut_paciente); 
    $separar= list($primero, $segundo) = explode("-",$puntos);


//Comprueba que rut sea correcto
if (validar_rut($primero, $segundo) == false) {

	echo "<script>alert('Error, Rut incorrecto.'); window.opener.location.reload(); window.close(); </script>";

//Si el paciente a insertar existe, se envía una alerta pop up al usuario y se redirecciona a la lista de pacientes.
}else if ($count == 1) {
	
	echo "<script>alert('Error, el paciente que intenta ingresar ya existe.'); window.opener.location.reload(); window.close(); </script>";

}else{


	//Si no existe el paciente se inserta en tabla paciente.
	$insert_paciente = $bdd->prepare("INSERT INTO paciente (rut_paciente, nombre_paciente, apellidop_paciente, apellidom_paciente, telefono_paciente, direccion_paciente) VALUES (?,?,?,?,?,?)");
	$insert_paciente->execute(array($rut_paciente, $nombre_paciente, $apellidop_paciente, $apellidom_paciente, $telefono_paciente, $direccion_paciente));

	//Fecha actual
	date_default_timezone_set("Chile/Continental");
	$date_now 	    = date('Y-m-d H:i:s');

	//Tipo movimiento
	$tipo_movimiento 		= "Acción Insert";
	$descripcion_movimiento = "Se agregó el paciente con rut: ".$rut_paciente;

	//Se inserta el movimiento del usuario la bitácora
	$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
	$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));

//Si el resultado es exitoso, muestra un mensaje en pop up.
if ($insert_paciente && $insert_bitacora) {
	
	echo "<script>alert('Paciente agregado con éxito.'); window.opener.location.reload(); window.close();</script>";

//Si ocurre un error, muestra un mensaje en pop up.
}else{

	echo "<script>alert('Error, ocurrió un problema al guardar el paciente.'); window.opener.location.reload(); window.close();</script>";
}

}	

}

}

?>