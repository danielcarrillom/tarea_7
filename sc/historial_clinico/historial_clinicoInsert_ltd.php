<?php

//Conexión a la base de datos.
require_once('../bdd.php');

include('../sesion_limited.php');

if (isset($_POST['form_historial_clinico'])) {

if ($_POST['nombre_paciente'] == ''  or ! preg_match("/^[a-zA-Z ]{2,50}+$/", $_POST['nombre_paciente'])) {

    echo "<script>alert('Error, el nombre seleccionado no es correcto (solo letras de 2 a 50 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['observacion_preliminar'] == '' or ! preg_match("/^[a-zA-Z0-9 ]{2,100}+$/", $_POST['observacion_preliminar'])) {

    echo "<script>alert('Error, la observavción ingresada no es correcto (solo letras, números y mínimo de 2 a 100 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else if ($_POST['estado'] == '' or ! preg_match("/^[a-zA-Z]{6,9}+$/", $_POST['estado'])) {

    echo "<script>alert('Error, el estado seleccionado no es correcto (solo 6 a 9 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else{

	//Recibe los campos del formulario y los guarda en una variable.
	$nombre_paciente	= $_POST['nombre_paciente'];
	$fecha_ingreso			= date("Y-m-d",strtotime($_POST['fecha_ingreso']));
	$observacion_preliminar = $_POST["observacion_preliminar"];
	$estado					= $_POST['estado'];

	list($nombre, $apellidop, $apellidom) = explode(" ",$nombre_paciente);

	//Consulta y verifica que registro exista actualmente.
	$select_paciente_historial = $bdd->prepare("SELECT id_historial_clinico, rut_paciente, nombre_paciente, apellidop_paciente, apellidom_paciente, estado, paciente_rut_paciente FROM paciente INNER JOIN historial_clinico ON paciente.rut_paciente=historial_clinico.paciente_rut_paciente WHERE nombre_paciente=? AND apellidop_paciente=? AND apellidom_paciente=? AND estado=?"); 
	$select_paciente_historial->execute(array($nombre, $apellidop, $apellidom, $estado));

	$count = $select_paciente_historial->rowCount();
	

	//Consulta el RUT del paciente a través del nombre.
	$select_funcionario = $bdd->prepare("SELECT id_perfil, usuario, rut_funcionario FROM perfil INNER JOIN funcionario ON perfil.id_perfil=funcionario.perfil_id_perfil WHERE usuario=?"); 
	$select_funcionario->execute(array($usuario));
	$row_funcionario = $select_funcionario->fetch();

	$rut_funcionario = $row_funcionario["rut_funcionario"];

	//Consulta el rut del paciente a través de variable de sesión.
	$select_paciente = $bdd->prepare("SELECT rut_paciente, nombre_paciente, apellidop_paciente, apellidom_paciente FROM paciente WHERE nombre_paciente=? AND  apellidop_paciente=? AND apellidom_paciente=?"); 
	$select_paciente->execute(array($nombre, $apellidop, $apellidom));
	$row = $select_paciente->fetch();

	$rut_paciente = $row["rut_paciente"];


	if ($count == 0) {


	//Se inserta el nuevo historial mientras el paciente no tenga un historial activo.
	$insert_historial = $bdd->prepare("INSERT INTO historial_clinico (fecha_ingreso, observacion_preliminar, estado, paciente_rut_paciente) VALUES (?,?,?,?)");
	$insert_historial->execute(array($fecha_ingreso, $observacion_preliminar, $estado, $rut_paciente));

	//Se inserta el nuevo historial.
	$insert_supervisa = $bdd->prepare("INSERT INTO supervisa (funcionario_rut_funcionario, paciente_rut_paciente) VALUES (?,?)");
	$insert_supervisa->execute(array($rut_funcionario, $rut_paciente));

	//Fecha actual
	date_default_timezone_set("Chile/Continental");
	$date_now 	    = date('Y-m-d H:i:s');

		//Tipo movimiento
	$tipo_movimiento 		= "Acción Insert";
	$descripcion_movimiento = "Se agregó el historial de paciente: ".$nombre_paciente;

	//Se inserta el movimiento del usuario la bitácora
	$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
	$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));

	//Si el resultado es exitoso, muestra un mensaje en pop up.
	if ($insert_historial && $insert_supervisa && $insert_bitacora) {
	
		echo "<script>alert('Historial agregado con éxito.'); window.opener.location.reload(); window.close();</script>";

	//Si ocurre un error, muestra un mensaje en pop up.
	}else{

		echo "<script>alert('Error, ocurrió un problema al guardar el historial.'); window.opener.location.reload(); window.close();</script>";
	}


	}else{


		echo "<script>alert('Error, el paciente ya tiene un historial activo. Favor dirigirse al módulo Editar si desea modificar información.'); window.opener.location.reload(); window.close();</script>";

}

}	

}	


?>