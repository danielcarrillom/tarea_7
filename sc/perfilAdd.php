<?php
include('sesion_full.php');
?>

<!DOCTYPE html>
<html>
<head>

	<title>Nuevo Perfil</title>

		<!--ESTILOS Y SCRIPT NECESARIOS PARA DISEÑO DE INTERFAZ -->
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" href="../css/fontawesome/css/all.css">
		<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>

<body>

		<div id="content_table_view">
		<div class="panel panel-primary" id="content_table">
    		<div class="panel-heading">
        		<h3 class="panel-title"><i class="fas fa-file-signature"></i>  SISTEMA SEGUIMIENTO PACIENTES COVID-19</h3>
    				</div>

<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Crear Perfil
</div> 

<div class="container" style="width: 60%;">
    <div class="row">
        <div class="span12">
            <div class="content">
               
			<fieldset class="fieldset_edit">

					<!--FORMULARIO AGREGAR PERFIL. A SU VEZ ENVÍA DATOS A SCRIPT PARA INSERTAR-->
            		<form  action="perfil/perfilInsert.php" method="POST" autocomplete="off">

             				<div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Usuario</span>
					            	<input type="text" name="usuario" class="form-control span6 tip" placeholder="EJ: danielc" style="width:400px;"
					            	pattern="[a-z]{4,15}" maxlength="15"  title="Solo se acepta letras minúsculas. Longitud mínimo 4 y máximo 15." required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Contraseña</span>
					            	<input type="password" name="contrasena" class="form-control span6 tip" style="width:400px;"
					            	pattern="[a-z]+[0-9]{4,15}" maxlength="15" title="Solo se acepta letras minúsculas y números. Longitud mínimo 4 y máximo 15." required>
					        </div>

					        <br>

					        <div class="input-group">
								<span class="input-group-addon" style="width:200px;">Tipo Perfil</span>
									<select class="form-control" name="tipo_perfil" style="width: 400px; border-radius: 5px;" required>
											<option></option>
											<option value='Full'>Completo</option>
											<option value='Limited'>Limitado</option>
									</select>					
							</div>

							<div class="control-group" style="margin-top: 5%;">
								<div class="controls">
                                   <button type="submit" name="form_perfil" class="btn btn-success">Guardar</button>
                                   <button type="submit" onclick="window.close();" class="btn btn-danger">Cancelar</button>
								</div>
							</div>
					</form>

				</fieldset>
            </div>
            <!--/.content-->
        </div>
        <!--/.span9-->
    </div>
</div>
<!--/.container-->
    </div>	
  </div>
</body>
</html>