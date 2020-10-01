<?php
include('sesion_full.php');
?>

<!DOCTYPE html>
<html>
<head>

	<title>Modificar Perfil</title>

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

<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Editar Perfil de Usuario
</div> 

<div class="container" style="width: 60%;">
    <div class="row">
        <div class="span12">
            <div class="content">
               
			<fieldset class="fieldset_edit">

					<?php


					//CONEXIÓN A LA BD.
					require_once('bdd.php');

						//CONSULTA LOS DATOS DEL PERFIL A TRAVÉS DE ID.
			            $id = intval($_GET['id']);
						$select_perfil = $bdd->prepare("SELECT * FROM perfil WHERE id_perfil=?");
						$select_perfil->execute(array($id));
						$count = $select_perfil->rowCount();
						
						//CONDICIÓN SI ES IGUAL A CERO REDIRECCIONA AL MANTENEDOR DE PERFILES.
						if($count == 0){

							header("Location: ../view_perfil.php");

						//EN CASO QUE EXISTA LLENA LOS INPUT PARA EDITAR.
						}else{

							$row = $select_perfil->fetch();
						}
			
					?>

						<!--FORMULARIO DE EDICIÓN-->
            <form  action="perfil/perfilUpdate.php" method="POST" autocomplete="off">
            	<?php $id_perfil = $row['id_perfil']; ?>
            <input type="hidden" name="id_perfil" value="<?php echo $id_perfil; ?>">

             		<div class="input-group">
					    <span class="input-group-addon" style="width:200px;">Usuario</span>
					        <input type="text" name="usuario" class="form-control span6 tip" value="<?php echo $row['usuario']; ?>" style="width:400px;" 
					        pattern="[a-z]{4,15}" maxlength="15"  title="Solo se acepta letras minúsculas. Longitud mínimo 4 y máximo 15." required>
					</div>

					<br>

					<div class="input-group">
					    <span class="input-group-addon" style="width:200px;">Contraseña</span>
					        <input type="password" name="contrasena" class="form-control span6 tip" value="<?php echo $row['contraseña']; ?>" style="width:400px;"
					        pattern="[a-z]+[0-9]{4,15}" maxlength="15" title="Solo se acepta letras minúsculas y números. Longitud mínimo 4 y máximo 15." required>
					</div>

					<br>

					<div class="input-group">
					    <span class="input-group-addon" style="width:200px;">Fecha Creación</span>
					        <input type="text" name="fecha_creacion" class="form-control span6 tip" value="<?php echo date("d-m-Y",strtotime($row['fecha_creacion'])); ?>" style="width:400px;" readonly="readonly" required>
					</div>

					<br>

					<!--COMBOBOX QUE CARGA EL PERFIL DESDE LA BD-->
					<div class="input-group">
					    <span class="input-group-addon" style="width:200px;">Tipo Perfil</span>
					        <?php
								$combo_perfil = $bdd->prepare("SELECT tipo_perfil FROM perfil"); 
								$combo_perfil->execute();
							?>
								<select data-column="3"  class="form-control span6 tip" name="tipo_perfil" style="width: 400px;height: 30px; border-radius: 5px;" required>

							<?php if ($row["tipo_perfil"] == 'Limited') { ?>
									<option value="<?php echo $row["tipo_perfil"]; ?>">Limitado</option>';

							<?php }else if ($row["tipo_perfil"] == 'Full') { ?>	¿
									<option value="<?php echo $row["tipo_perfil"]; ?>">Completo</option>';

							<?php } 
								echo"<option value='Limited'>Limitado</option>";
								echo"<option value='Full'>Completo</option>";
							echo'</select>';

							?>
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