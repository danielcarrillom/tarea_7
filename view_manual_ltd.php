<?php
include('sc/sesion_limited.php');
?>

<!DOCTYPE html>
<html>
	<title>Manuales</title>
	<head>
		<!--ESTILOS Y SCRIPT NECESARIOS PARA DISEÑO DE INTERFAZ -->
		<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/responsive.css">
		<link rel="stylesheet" href="css/fontawesome/css/all.css">
		<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="js/bootstrap/bootstrap.min.css">


	</head>

	<body>
	
	<!--ESTRUCTURA DEL DISEÑO DEL MANTENEDOR-->
	<div id="content_table_view">
		<div class="panel panel-primary" id="content_table">
    		<div class="panel-heading">
        		<h3 class="panel-title"><i class="fas fa-file-signature"></i>  SISTEMA SEGUIMIENTO PACIENTES COVID-19</h3>
    				</div>

    					<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Manual de usuario y sistema</div> 

    					<div id="content_sesion">
				    			<div id="content_user"><i class="fas fa-user-alt"></i> <?php echo $nombre_perfil." ".$apellido_perfil ?></div>
									<div id="content_logout">
										<form method='POST'>
										<i class="fas fa-sign-out-alt"></i><button class="button_login" id='salir' name='salir' value='1' style="background: white; height: 10px;">Cerrar Sesión</button>
									</form>
								</div>
						</div>
								

								<fieldset style="border-radius: 5px; width: 55%; margin:0 auto; margin-bottom: 2%; background-color: #F9F9F9; border:1px solid #EDEDED;">

									<div style="width: 50%; height: 300px; margin:0 auto; margin-top: 2%;">
										<h4><b>Seleccione el manual que desea descargar</b></h4>
										<br>
											
											<table class="table table-bordered">
												<thead>			
													<tr>	
														<td class="danger" style="font-weight: bold;">Tipo</td>
														<td class="danger" style="font-weight: bold;">Descargar</td>
													</tr>
												</thead>
												<tbody>
												  	<tr>
												    	<td>Manual de usuario</td>
												    	<td><center><a href="sc/manual/manual_usuario.pdf" target="_blank" style="color: black;"><i class="fa fa-download" aria-hidden="true"></i></a></center></td>
												  	</tr>
												  	<tr>
												    	<td>Manual de sistema</td>
												    	<td><center><a href="sc/manual/manual_sistema.pdf" style="color: black;"><i class="fa fa-download" aria-hidden="true"></i></a></center></td>
												  	</tr>

												</tbody>
											</table>

									</div>

								</fieldset>



					</div>
				</div>
			</div>
		</div>
	</body>
</html>
  
