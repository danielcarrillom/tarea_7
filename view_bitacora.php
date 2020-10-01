<?php
include('sc/sesion_full.php');
?>

<!DOCTYPE html>
<html>
	<title>Bitácora</title>
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

		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
		<script src="jquery.ui.datepicker-es.js"></script>
		<script src="js/spanish_datepicker.js"></script>

		<script>
			$(function () {
			$("#from").datepicker({
			onClose: function (selectedDate) {
			$("#to").datepicker("option", "minDate", selectedDate);
			}
			});
			$("#to").datepicker({
			onClose: function (selectedDate) {
			$("#from").datepicker("option", "maxDate", selectedDate);
			}
			});
			});
		</script>

	</head>

	<body>
	
	<!--ESTRUCTURA DEL DISEÑO DEL MANTENEDOR-->
	<div id="content_table_view">
		<div class="panel panel-primary" id="content_table">
    		<div class="panel-heading">
        		<h3 class="panel-title"><i class="fas fa-file-signature"></i>  SISTEMA SEGUIMIENTO PACIENTES COVID-19</h3>
    				</div>

    					<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Bitácora de movimientos BD</div> 

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
										<h4><b>Seleccione fechas de búsqueda</b></h4>
										<br>
										<form method="POST" action="sc/reporte/reporte_bitacora.php" autocomplete="off">
										  <div class="form-group row">
										    <label class="col-sm-2 col-form-label">Desde</label>
										    <div class="col-sm-10">
										      <input type="text" id="from" name="from" />
										    </div>
										  </div>
										  <div class="form-group row">
										    <label class="col-sm-2 col-form-label">Hasta</label>
										    <div class="col-sm-10">
										      <input type="text" id="to" name="to" />
										    </div>
										  </div>
										  <div class="control-group" style="margin-top: 5%;">
											<div class="controls">
			                                   <button type="submit" name="buscar_entre_fechas" class="btn btn-success">Exportar</button>
											</div>
										</div>
										</form>

									</div>

								</fieldset>



					</div>
				</div>
			</div>
		</div>
	</body>
</html>
  
