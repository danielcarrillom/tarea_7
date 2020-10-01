<?php
session_start();

//CONEXIÓN A LA BD
include("bdd.php");

//VARIABLE DE SESIÓN
$profile_limited = $_SESSION['login_limited_sys'];

//CONSULTA A LA BD
$sql_perfil = $bdd->prepare("SELECT id_perfil, perfil_id_perfil, usuario, nombre_funcionario, apellidop_funcionario, tipo_perfil FROM perfil INNER JOIN funcionario ON perfil.id_perfil=funcionario.perfil_id_perfil WHERE usuario=?");
$sql_perfil->execute(array($profile_limited));

$row_perfil = $sql_perfil->fetch();

//RESULTADO GUARDADO EN VARIABLE
$usuario 			= $row_perfil["usuario"];
$nombre_perfil 		= $row_perfil["nombre_funcionario"];
$apellido_perfil 	= $row_perfil["apellidop_funcionario"];
$tipo_perfil 		= $row_perfil["tipo_perfil"];


if(!empty($_POST['salir']))

{
	$_SESSION['login_limited_sys']='';
	session_destroy();
}

if(empty($_SESSION['login_limited_sys']))
{
	header("Location: index.php");
}

?>