<?php
include('sc/sesion_full.php');
?>

<!DOCTYPE html>
<html>
	<title>Gestión BD</title>
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

    					<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Gestión de BD, respaldo y restauración</div> 

    					<div id="content_sesion">
				    			<div id="content_user"><i class="fas fa-user-alt"></i> <?php echo $nombre_perfil." ".$apellido_perfil ?></div>
									<div id="content_logout">
										<form method='POST'>
										<i class="fas fa-sign-out-alt"></i><button class="button_login" id='salir' name='salir' value='1' style="background: white; height: 10px;">Cerrar Sesión</button>
									</form>
								</div>
						</div>
								
    							<?php

    								include('sc/import_bd.php');

    							?>

								<fieldset style="border-radius: 5px; width: 55%; margin:0 auto; margin-bottom: 2%; background-color: #F9F9F9; border:1px solid #EDEDED;">

									<div style="width: 50%; height: 300px; margin:0 auto;">
								
										<div class="form-group">
									        <a href="sc/backup_bd.php" class="btn btn-success" role="button" style="margin-top: 10%;">Descargar BD</a>
									    </div>

										<form method="post" action="" enctype="multipart/form-data" id="frm-restore">
											<div class="form-row">
											    <label style="margin-top: 5%;">SELECCIONAR ARCHIVO SQL</label>
											        <div>
											            <input type="file" name="backup_file" class="input-file" />
											        </div>
											</div>

											<br>

											<div>
											    <input type="submit" name="restore" value="Importar BD" class="btn btn-info" />
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
  
