<?php

//Conexión a la base de datos.
require_once('../bdd.php');

include('../sesion_limited.php');

if (isset($_POST['form_historial_clinico'])) {

if ($_POST['nombre_paciente'] == '' or ! preg_match("/^[a-zA-Z0-9 ]{2,100}+$/", $_POST['observacion_llamado'])) {

    echo "<script>alert('Error, la observavción ingresada no es correcto (solo letras, números y mínimo de 2 a 100 caracteres)'); history.go(-1); </script>";

}else if ($_POST['estado'] == '' or ! preg_match("/^[a-zA-Z]{6,10}+$/", $_POST['estado'])) {

    echo "<script>alert('Error, el estado seleccionado no es correcto (solo 6 a 9 caracteres)'); window.opener.location.reload(); window.close(); </script>";

}else{

	//Recibe ID y demás campos desde el formulario.
	$id_historial_clinico 		= $_POST['id_historial_clinico'];
	$nombre_paciente	  		= $_POST['nombre_paciente'];
	$fecha_ingreso	  			= date("Y-m-d",strtotime($_POST['fecha_ingreso']));
	$fecha_hora_llamada   		= $_POST['fecha_llamada']." ".$_POST['hora_llamada'];
	$observacion_preliminar	  	= $_POST['observacion_preliminar'];
	$observacion_llamado	  	= $_POST['observacion_llamado'];
	$estado				  		= $_POST['estado'];

	list($nombre, $apellidop, $apellidom) = explode(" ",$nombre_paciente);

	//Consulta y verifica que paciente exista actualmente y esté activo.
	$select_paciente_historial = $bdd->prepare("SELECT id_historial_clinico, rut_paciente, nombre_paciente, apellidop_paciente, apellidom_paciente, estado, paciente_rut_paciente FROM paciente INNER JOIN historial_clinico ON paciente.rut_paciente=historial_clinico.paciente_rut_paciente WHERE nombre_paciente=? AND apellidop_paciente=? AND apellidom_paciente=? AND estado=?"); 
	$select_paciente_historial->execute(array($nombre, $apellidop, $apellidom, $estado));

	$count = $select_paciente_historial->rowCount();

	$row_historial = $select_paciente_historial->fetch();

	//Consulta el ID del paciente a través del nombre.
	$select_funcionario = $bdd->prepare("SELECT id_perfil, usuario, rut_funcionario FROM perfil INNER JOIN funcionario ON perfil.id_perfil=funcionario.perfil_id_perfil WHERE usuario=?"); 
	$select_funcionario->execute(array($usuario));
	$row_funcionario = $select_funcionario->fetch();

	$rut_funcionario = $row_funcionario["rut_funcionario"];


	//Si existe un paciente con historial activo.
	if ($count == 1) {

	//Extrae el ID del historial para posteriormente editar.
	$id_historial = $row_historial["id_historial_clinico"];

	//Si existe un paciente con historial activo, se edita el registro y campo observación, mientras esté activo.
	$update_historial = $bdd->prepare("UPDATE historial_clinico SET fecha_ingreso=?, observacion_preliminar=?, estado=? WHERE id_historial_clinico=?");
	$update_historial->execute(array($fecha_ingreso, $observacion_preliminar, $estado, $id_historial));

	//Se insertar la fecha y hora de llamado agregándola al historial actual.
	$insert_llamada = $bdd->prepare("INSERT INTO historial_llamada (fecha_hora_llamada, observacion_llamada, historial_clinico_id_historial_clinico) VALUES (?,?,?)");
	$insert_llamada->execute(array($fecha_hora_llamada, $observacion_llamado, $id_historial_clinico));
	
	//Fecha actual
	date_default_timezone_set("Chile/Continental");
	$date_now 	    = date('Y-m-d H:i:s');
	
	//Tipo movimiento
	$tipo_movimiento 		= "Acción Insert";
	$descripcion_movimiento = "Se agregó historial de llamada a paciente: ".$nombre_paciente;

	//Se inserta el movimiento del usuario la bitácora
	$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
	$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));

	//Si el resultado es exitoso, muestra un mensaje en pop up.
	if ($update_historial && $insert_llamada && $insert_bitacora) {
	
		echo "<script>alert('Historial insertado con éxito.'); window.opener.location.reload(); window.close();</script>";

	//Si ocurre un error, muestra un mensaje en pop up.
	}else{

		echo "<script>alert('Error, ocurrió un problema al guardar el historial.'); window.opener.location.reload(); window.close();</script>";
	}

	}

	}

}







?>