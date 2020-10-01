<?php

//Conexión a la base de datos.
require_once('../bdd.php');

include('../sesion_full.php');

//Recibe el RUT desde el botón eliminar.
if(isset($_GET['id'])){

//Se guarda en una variable.
$rut_paciente = $_GET['id'];

//Elimina el RUT del paciente en la tabla intermedia "SUPERVISA".
$delete_supervisa = $bdd->prepare("DELETE FROM supervisa WHERE paciente_rut_paciente=?");
$delete_supervisa->execute(array($rut_paciente));

//Elimina el paciente de acuerdo al RUT recibido.
$delete_paciente = $bdd->prepare("DELETE FROM paciente WHERE rut_paciente=?");
$delete_paciente->execute(array($rut_paciente));

//Elimina el historial clínico asociado al paciente.
$delete_historial_clinico = $bdd->prepare("DELETE FROM historial_clinico WHERE paciente_rut_paciente=?");
$delete_historial_clinico->execute(array($rut_paciente));

//Fecha actual
date_default_timezone_set("Chile/Continental");
$date_now 	    = date('Y-m-d H:i:s');
	
//Tipo movimiento
$tipo_movimiento 		= "Acción Delete";
$descripcion_movimiento = "Se eliminó el paciente con rut: ".$rut_paciente;

//Se inserta el movimiento del usuario la bitácora
$insert_bitacora = $bdd->prepare("INSERT INTO movimiento_bitacora (nombre_usuario, tipo_usuario, tipo_movimiento, descripcion_movimiento, fecha_movimiento) VALUES (?,?,?,?,?)");
$insert_bitacora->execute(array($usuario, $tipo_perfil, $tipo_movimiento, $descripcion_movimiento, $date_now));


//Si la consulta se ejecuta correctamente.
if ($delete_supervisa && $delete_paciente && $delete_historial_clinico) {

	echo "<script>alert('Paciente eliminado!'); window.opener.location.reload(); window.close();</script>";

//De lo contrario muestra error.
}else{

	echo "<script>alert('Error, ocurrió un problema al eliminar el Paciente!'); window.opener.location.reload(); window.close();</script>";

}

}

?>