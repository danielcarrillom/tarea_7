<?php
include('sc/sesion_full.php');
?>

<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
	<link rel="stylesheet" href="css/fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="js/bootstrap/bootstrap.min.css">

	<style type="text/css">
		body{

			background: #E5F4FB
		}
	</style>
</head>
<body>

	<div id="content_sesion">
    	<div id="content_user"><i class="fas fa-user-alt"></i> <?php echo $nombre_perfil." ".$apellido_perfil ?></div>
			<div id="content_logout">
				<form method='POST'>
					<i class="fas fa-sign-out-alt"></i><button class="button_login_index" id='salir' name='salir' value='1' style="background: #E5F4FB height: 10px;">Cerrar Sesión</button>
				</form>
			</div>
	</div>

		<br>
		<br>

		<center style="margin-top: 5%; font-weight: bold; font-size: 15pt;"><p>ADMINISTRACIÓN MÓDULOS -SEGUIMIENTO DE PACIENTES COVID-19-</center>
		<center style="margin-top: 5%;"><a href="view_hospital.php" class="btn btn-success" target="_blank">HOSPITAL</a></center>
		<br>
		<center><a href="view_perfil.php" class="btn btn-success" target="_blank">PERFIL</a></center>
		<br>
		<center><a href="view_funcionario.php" class="btn btn-success" target="_blank">FUNCIONARIO</a></center>
		<br>
		<center><a href="view_paciente.php" class="btn btn-success" target="_blank">PACIENTE</a></center>
		<br>
		<center><a href="view_historial_clinico_fll.php" class="btn btn-success" target="_blank">HISTORIAL CLÍNICO</a></center>
		<br>
		<center><a href="view_bitacora.php" class="btn btn-info" target="_blank">BITÁCORA MOVIMIENTOS</a></center>
		<br>
		<center><a href="view_manual_fll.php" class="btn btn-info" target="_blank">MANUAL DE USUARIO Y SISTEMA</a></center>
		<br>
		<center><a href="view_importar_exportar.php" class="btn btn-warning" target="_blank">ADMIN. BASE DE DATOS</a></center>


</body>
</html>


