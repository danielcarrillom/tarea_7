<?php
include('sesion_limited.php');
?>

<!DOCTYPE html>
<html>
<head>

	<title>Nuevo Historial Clínico</title>

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

<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Crear Historial Clínico
</div> 

<div class="container" style="width: 60%;">
    <div class="row">
        <div class="span12">
            <div class="content">
               
			<fieldset class="fieldset_edit">

					<!--FORMULARIO AGREGAR HISTORIAL CLÍNICO. A SU VEZ ENVÍA DATOS A SCRIPT PARA INSERTAR-->
             		<form  action="historial_clinico/historial_clinicoInsert_ltd.php" method="POST" autocomplete="off">
             				<div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Paciente</span>
					            	<?php

					            		//CONEXIÓN A LA BD
										require_once('bdd.php');
										$combo_paciente = $bdd->prepare("SELECT nombre_paciente, apellidop_paciente, apellidom_paciente FROM paciente"); 
										$combo_paciente->execute();
									?>
										<select class="form-control" name="nombre_paciente" style="width: 400px; border-radius: 5px;" required>
										<option value="">-- Seleccionar --</option>

									<?php
										while ($row = $combo_paciente->fetch()){
										$nombre_paciente 	= $row["nombre_paciente"];
										$apellidop_paciente = $row["apellidop_paciente"];
										$apellidom_paciente = $row["apellidom_paciente"];
										
										echo"<option value='$nombre_paciente $apellidop_paciente $apellidom_paciente'>".$nombre_paciente." ".$apellidop_paciente." ".$apellidom_paciente."</option>";			
									}
										echo'</select>';
									?>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Fecha Ingreso</span>
					            	<input type="date" name="fecha_ingreso" class="form-control span6 tip" style="width:400px;" required>
					        </div>

					        <br>

					        <div class="input-group">
							    <span class="input-group-addon" style="width:200px;">Observación Preliminar</span>
							    	<textarea class="form-control" name="observacion_preliminar" rows="3" style="width:400px;" 
							    	pattern="[A-Za-z ]+[0-9]{2,100}" maxlength="100"  title="Solo se acepta letras y números. Longitud mínima de 2 a 100 caracteres." required></textarea>
							</div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Estado</span>
					            	<input type="text" name="estado" class="form-control span6 tip" style="width:400px;" readonly="readonly" value="Activo" required>
					        </div>

							<div class="control-group" style="margin-top: 5%;">
								<div class="controls">
                                   <button type="submit" name="form_historial_clinico" class="btn btn-success">Guardar</button>
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