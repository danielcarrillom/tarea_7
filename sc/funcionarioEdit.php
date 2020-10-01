<?php
include('sesion_full.php');
?>

<!DOCTYPE html>
<html>
<head>

	<title>Funcionario</title>

		<!--ESTILOS Y SCRIPT NECESARIOS PARA DISEÑO DE INTERFAZ -->
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="stylesheet" href="../css/fontawesome/css/all.css">
		<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

		<!--SCRIPT QUE FORMATEA EL RUT. LE PONE PUNTOS Y GUION-->
		<script type="text/javascript">
			function formatRut(rut_funcionario)
			{rut_funcionario.value=rut_funcionario.value.replace(/[.-]/g, '')
			.replace( /^(\d{1,2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4')}
		</script>

</head>

<body>

		<div id="content_table_view">
		<div class="panel panel-primary" id="content_table">
    		<div class="panel-heading">
        		<h3 class="panel-title"><i class="fas fa-file-signature"></i>  SISTEMA SEGUIMIENTO PACIENTES COVID-19</h3>
    				</div>

<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Editar Funcionario
</div> 

<div class="container" style="width: 60%;">
    <div class="row">
        <div class="span12">
            <div class="content">
               
			<fieldset class="fieldset_edit">

					<?php


					//CONEXIÓN A LA BD.
					require_once('bdd.php');

						//CONSULTA LOS DATOS DEL FUNCIONARIO A TRAVÉS DE ID.
			            $id = $_GET['id'];
						$select_funcionario = $bdd->prepare("SELECT * FROM funcionario WHERE rut_funcionario=?");
						$select_funcionario->execute(array($id));
						$count = $select_funcionario->rowCount();
						
						//CONDICIÓN SI ES IGUAL A CERO REDIRECCIONA AL MANTENEDOR DE FUNCIONARIOS.
						if($count == 0){

							header("Location: ../view_funcionario.php");

						//EN CASO QUE EXISTA LLENA LOS INPUT PARA EDITAR.
						}else{

							$row = $select_funcionario->fetch();
							
						}
			
					?>

			<!--FORMULARIO DE EDICIÓN-->
            <form  action="funcionario/funcionarioUpdate.php" method="POST" autocomplete="off">

            	<!--VARIABLE IDENTIFICADOR DE LOS REGISTROS-->
            	<?php $rut_funcionario = $row['rut_funcionario']; ?>

            <!--ENVÍA RUT OCULTO-->
            <input type="hidden" name="rut_funcionario" value="<?php echo $rut_funcionario; ?>">

             				<div class="input-group">
					            <span class="input-group-addon" style="width:200px;">RUT</span>
					            	<input type="text" name="rut_funcionario" class="form-control span6 tip" value="<?php echo $row['rut_funcionario']; ?>" style="width:400px;" 
					            	onkeyup="formatRut(this)" maxlength="12" pattern="[0-9]+[.- k]{11,12}" required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Nombre</span>
					            	<input type="text" name="nombre_funcionario" class="form-control span6 tip" value="<?php echo $row['nombre_funcionario']; ?>" style="width:400px;"
					            	pattern="[A-Za-z ]{2,20}" maxlength="20"  title="Solo se aceptan letras. Longitud mínima de 2 a 20 caracteres." required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Apellido Paterno</span>
					            	<input type="text" name="apellidop_funcionario" class="form-control span6 tip" value="<?php echo $row['apellidop_funcionario']; ?>" style="width:400px;"
					            	pattern="[A-Za-z ]{2,20}" maxlength="20"  title="Solo se aceptan letras. Longitud mínima de 2 a 20 caracteres." required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Apellido Materno</span>
					            	<input type="text" name="apellidom_funcionario" class="form-control span6 tip" value="<?php echo $row['apellidom_funcionario']; ?>" style="width:400px;" 
					            	pattern="[A-Za-z ]{2,20}" maxlength="20"  title="Solo se aceptan letras. Longitud mínima de 2 a 20 caracteres." required>
					        </div>

					        <br>

					        <div class="input-group">
					            <span class="input-group-addon" style="width:200px;">Teléfono</span>
					            	<input type="text" name="telefono_funcionario" class="form-control span6 tip" value="<?php echo $row['telefono_funcionario']; ?>" style="width:400px;" placeholder="EJ: 92876541" 
					            	pattern="[0-9]{8}" maxlength="8" title="Solo se aceptan números de 8 dígitos" required>
					        </div>

					        <br>

					        <div class="input-group">
					           	 <span class="input-group-addon" style="width:200px;">Nombre Hospital</span>
					            	<?php

					            		$select_hospital = $bdd->prepare("SELECT hospital_id_hospital, id_hospital, nombre_hospital FROM hospital INNER JOIN funcionario ON funcionario.hospital_id_hospital=hospital.id_hospital WHERE rut_funcionario=?");
					            		$select_hospital->execute(array($rut_funcionario));
					            		$row_hospital = $select_hospital->fetch();

										$combo_hospital = $bdd->prepare("SELECT nombre_hospital FROM hospital"); 
										$combo_hospital->execute();
									?>
									<select data-column="3"  class="form-control span6 tip" name="nombre_hospital" style="width: 400px;height: 30px; border-radius: 5px;" required>
									<option value="<?php echo $row_hospital["nombre_hospital"]; ?>"><?php echo $row_hospital["nombre_hospital"]; ?></option>';
									<?php
										while ($row_hosp = $combo_hospital->fetch()){
										$nombre_hospital = $row_hosp["nombre_hospital"];
										echo"<option value='$nombre_hospital'>".$nombre_hospital."</option>";				
									}
										echo'</select>';
									?>
					        </div>
					        <br>
					        <div class="input-group">
					           	 <span class="input-group-addon" style="width:200px;">Tipo Perfil</span>
					            	<?php

					            		$select_perfil = $bdd->prepare("SELECT perfil_id_perfil, id_perfil, tipo_perfil FROM funcionario INNER JOIN perfil ON funcionario.perfil_id_perfil=perfil.id_perfil WHERE rut_funcionario=?");
					            		$select_perfil->execute(array($rut_funcionario));
					            		$row_perfil = $select_perfil->fetch();

										$combo_perfil = $bdd->prepare("SELECT tipo_perfil FROM perfil"); 
										$combo_perfil->execute();
									?>

									<select data-column="3"  class="form-control span6 tip" name="tipo_perfil" style="width: 400px;height: 30px; border-radius: 5px;" required>

									<?php if ($row_perfil == 'Full') { ?>
										<option value="<?php echo $row_perfil["tipo_perfil"]; ?>">Completo</option>';
									<?php }else{ ?>
										<option value="<?php echo $row_perfil["tipo_perfil"]; ?>">Completo</option>';
									<?php }

										echo"<option value='Limited'>Limitado</option>";
										echo"<option value='Full'>Completo</option>";
										echo'</select>';
									?>
					        </div>

							<div class="control-group" style="margin-top: 5%;">
								<div class="controls">
                                   <button type="submit" name="form_funcionario" class="btn btn-success">Guardar</button>
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