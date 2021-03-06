<?php
include('sesion_full.php');
?>

<!DOCTYPE html>
<html>
<head>

	<title>Nuevo Paciente</title>

		<!--ESTILOS Y SCRIPT NECESARIOS PARA DISEÑO DE INTERFAZ -->
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" href="../css/fontawesome/css/all.css">
		<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!--SCRIPT QUE FORMATEA EL RUT. LE PONE PUNTOS Y GUION-->
		<script type="text/javascript">
			function formatRut(rut_paciente)
			{rut_paciente.value=rut_paciente.value.replace(/[.-]/g, '')
			.replace( /^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4')}
		</script>

</head>

<body>

	<div id="content_table_view">
		<div class="panel panel-primary" id="content_table">
    		<div class="panel-heading">
        		<h3 class="panel-title"><i class="fas fa-file-signature"></i>  SISTEMA SEGUIMIENTO PACIENTES COVID-19</h3>
    				</div>

<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Crear Paciente
</div> 

<div class="container" style="width: 60%;">
    <div class="row">
        <div class="span12">
            <div class="content">
               
			<fieldset class="fieldset_edit">

					<!--FORMULARIO AGREGAR PACIENTE. A SU VEZ ENVÍA DATOS A SCRIPT PARA INSERTAR-->
             		<form  action="paciente/pacienteInsert.php" method="POST" autocomplete="off">

             				<div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Rut</span>
					            	<input type="text" name="rut_paciente" class="form-control span6 tip" style="width:400px;" 
					            	onkeyup="formatRut(this)" maxlength="12" pattern="[0-9.- k]{11,12}" required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Nombre</span>
					            	<input type="text" name="nombre_paciente" class="form-control span6 tip" style="width:400px;"
					            	pattern="[A-Za-z ]{2,20}" maxlength="20"  title="Solo se aceptan letras. Longitud mínima de 2 a 20 caracteres." required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Apellido Paterno</span>
					            	<input type="text" name="apellidop_paciente" class="form-control span6 tip" style="width:400px;"
					            	pattern="[A-Za-z ]{2,20}" maxlength="20"  title="Solo se aceptan letras. Longitud mínima de 2 a 20 caracteres." required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Apellido Materno</span>
					            	<input type="text" name="apellidom_paciente" class="form-control span6 tip" style="width:400px;" 
					            	pattern="[A-Za-z ]{2,20}" maxlength="20"  title="Solo se aceptan letras. Longitud mínima de 2 a 20 caracteres." required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Teléfono</span>
					            	<input type="text" name="telefono_paciente" class="form-control span6 tip" style="width:400px;"
					            	pattern="[0-9]{8}" maxlength="8" title="Solo se aceptan números de hasta 8 dígitos" required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Domicilio</span>
					            	<input type="text" name="direccion_paciente" class="form-control span6 tip" style="width:400px;"
					            	pattern="[A-Za-z ]+[0-9]{2,50}" maxlength="50"  title="Solo se aceptan letras y números. Longitud mínima de 2 a 50 caracteres." required>
					        </div>

							<div class="control-group" style="margin-top: 5%;">
								<div class="controls">
                                   <button type="submit" name="form_paciente" class="btn btn-success">Guardar</button>
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