<?php
include('sc/sesion_limited.php');
?>

<!DOCTYPE html>
<html>
	<title>Historial</title>
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

		<!--ARCHIVO JAVASCRIPT QUE PERMITE INTERACTUAR CON LOS REGISTROS DE LA BD-->
		<script type="text/javascript" language="javascript" src="js/datatable_historial_clinico_ltd.js"></script>

		<!--PERMITE REALIZAR BÚSQUEDA DESDE LOS INPUT DEL MANTENEDOR-->
		<script type="text/javascript">
			$('label').addClass('form-inline');
		$('select, input[type="search"]').addClass('form-control input-sm');
		</script>

	</head>

	<body>
	
	<!--ESTRUCTURA DEL DISEÑO DEL MANTENEDOR-->
	<div id="content_table_view">
		<div class="panel panel-primary" id="content_table">
    		<div class="panel-heading">
        		<h3 class="panel-title"><i class="fas fa-file-signature"></i>  SISTEMA SEGUIMIENTO PACIENTES COVID-19</h3>
    				</div>

    				

    				<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Historial Clínico Paciente</div> 

    					<!--BOTÓN PARA AÑADIR NUEVO HISTORIAL CLÍNICO-->
						<a href="sc/historial_clinicoAdd_ltd.php" class="btn btn-info" role="button" target="_blank" style="margin-right: 1%;">Nuevo Historial</a>Manuales  <a href="view_manual_ltd.php" target="_blank" style="color: black;"><i class="fa fa-download" aria-hidden="true"></i></a>

						<div id="content_sesion">
				    			<div id="content_user"><i class="fas fa-user-alt"></i> <?php echo $nombre_perfil." ".$apellido_perfil ?></div>
									<div id="content_logout">
										<form method='POST'>
										<i class="fas fa-sign-out-alt"></i><button class="button_login" id='salir' name='salir' value='1' style="background: white; height: 10px;">Cerrar Sesión</button>
									</form>
								</div>
						</div>

									<!--TABLA DEL MANTENEDOR-->
									<table id="employee-grid" class="table table-striped table-bordered dt-responsive" width="100%">
											<thead>
												<tr style="font-weight: bold; background-color:#FCF8E3;">											
													<th>RUT PACIENTE</th>
													<th>NOMBRE PACIENTE</th>
													<th>DIRECCIÓN</th>
													<th>FUNCIONARIO SUPERVISOR</th>
													<th>ESTADO</th>
													<th>OPCIONES</th>
												</tr>
											</thead>
											<thead>
												<tr>
													<!--INPUT DE BÚSQUEDA-->
													<td><input type="text" data-column="0" class="search-input-text" id="input_search" style="width: 150px;" autocomplete="off"></td>
													<td><input type="text" data-column="1"  class="search-input-text" id="input_search" style="width: 150px;" autocomplete="off"></td>
													<td><input type="text" data-column="2"  class="search-input-text" id="input_search" style="width: 150px;" autocomplete="off"></td>
													<td><input type="text" data-column="3"  class="search-input-text" id="input_search" style="width: 150px;" autocomplete="off"></td>
													<td><input type="hidden"></td>
													<td><input type="hidden"></td>

												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
					</body>
				</html>
  
