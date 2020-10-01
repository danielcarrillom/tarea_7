<?php
include('sesion_full.php');
?>

<!DOCTYPE html>
<html>
<head>

	<title>Editar historial clínico</title>

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

<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Editar Hospital Clínico
</div> 

<div class="container" style="width: 60%;">
    <div class="row">
        <div class="span12">
            <div class="content">
               
			<fieldset class="fieldset_edit">

					<?php


						//CONEXIÓN A LA BD.
						require_once('bdd.php');

						//CONSULTA LOS DATOS DEL HISTORIAL A TRAVÉS DE ID.
			            $id = intval($_GET['id']);
						$select_historial = $bdd->prepare("SELECT * FROM historial_clinico WHERE id_historial_clinico=?");
						$select_historial->execute(array($id));
						$count = $select_historial->rowCount();
						
						//CONDICIÓN SI ES IGUAL A CERO REDIRECCIONA AL MANTENEDOR DE HISTORIAL.
						if($count == 0){

							header("Location: ../view_historial_clinico.php");

						//EN CASO QUE EXISTA LLENA LOS INPUT PARA EDITAR.
						}else{

							$row = $select_historial->fetch();
							
						}
			
					?>

			<!--FORMULARIO DE EDICIÓN Y ENVÍA DATOS A OTRA PÁGINA PARA SER PROCESADO-->
            <form  action="historial_clinico/historial_clinicoUpdate.php" method="POST" autocomplete="off">

            	<!--VARIABLE IDENTIFICADOR DE LOS REGISTROS-->
            	<?php $id_historial_clinico = $row['id_historial_clinico']; ?>

            <!--ENVÍA RUT OCULTO-->
            <input type="hidden" name="id_historial_clinico" value="<?php echo $id_historial_clinico; ?>">

             				<div class="input-group">
					            	<span class="input-group-addon" style="width:200px;">Nombre Paciente</span>
					            	<?php

					            		//COMBOBOX PARA CARGAR PACIENTE DESDE LA BD.
					            		$combo_full = $bdd->prepare("SELECT id_historial_clinico, nombre_paciente, apellidop_paciente, apellidom_paciente, paciente_rut_paciente FROM paciente INNER JOIN historial_clinico ON paciente.rut_paciente=historial_clinico.paciente_rut_paciente WHERE id_historial_clinico=?"); 
										$combo_full->execute(array($id_historial_clinico));

										$row_full = $combo_full->fetch();
										$nombre_full = $row_full["nombre_paciente"]." ".$row_full["apellidop_paciente"]." ".$row_full["apellidom_paciente"];
								?>
					            	<input type="text" name="nombre_paciente" class="form-control span6 tip" readonly="readonly" value="<?php echo $nombre_full; ?>" style="width:400px;"  required>
					        </div>  

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Fecha Ingreso</span>
					            <input type="text" name="fecha_ingreso" class="form-control span6 tip" readonly="readonly" value="<?php echo date("d-m-Y",strtotime($row["fecha_ingreso"])); ?>" style="width:400px;" required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Observación Preliminar</span>
					            <input type="text" name="observacion_preliminar" class="form-control span6 tip" value="<?php echo $row["observacion_preliminar"]; ?>" style="width:400px;" readonly="readonly" required >
					        </div>

					        <br>				     

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Fecha Nuevo Llamado</span>
					            <input type="date" name="fecha_llamada" class="form-control span6 tip" style="width:400px;" required="">
					        </div>

					        <br>	

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Hora Nuevo Llamado</span>
					            <input type="time" name="hora_llamada" class="form-control span6 tip" style="width:400px;" required="">
					        </div>

					        <br>

					        <div class="input-group">
							    <span class="input-group-addon" style="width:200px;">Observación Llamada</span>
							    <textarea class="form-control" name="observacion_llamado" rows="3" style="width:400px;"
							    pattern="[A-Za-z ]+[0-9]{2,100}" maxlength="100"  title="Solo se acepta letras y números. Longitud mínima de 2 a 100 caracteres." required=""></textarea>

							</div>

					        <br>

					        <div class="input-group">
					           	 <span class="input-group-addon" style="width:200px;">Estado</span>
					            	<?php

										$combo_estado = $bdd->prepare("SELECT estado FROM historial_clinico"); 
										$combo_estado->execute();
									?>
									<select data-column="3"  class="form-control span6 tip" name="estado" style="width: 400px;height: 30px; border-radius: 5px;" required>
									<option value="<?php echo $row["estado"]; ?>"><?php echo $row["estado"]; ?></option>';
									<?php

										echo"<option value='Activo'>Activo</option>";
										echo"<option value='Finalizado'>Finalizado</option>";

										echo'</select>';
									?>
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