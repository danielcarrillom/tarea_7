<?php
include('sesion_full.php');
?>

<!DOCTYPE html>
<html>
<head>

	<title>Hospital</title>

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

<div class="alert alert-success" style="font-size: 13pt; font-weight: bold;"><i class="fas fa-external-link-alt"></i>  Editar Hospital
</div> 

<div class="container" style="width: 60%;">
    <div class="row">
        <div class="span12">
            <div class="content">
               
			<fieldset class="fieldset_edit">

					<?php


					//CONEXIÓN A LA BD.
					require_once('bdd.php');

						//CONSULTA LOS DATOS DEL HOSPITAL A TRAVÉS DE ID.
			            $id = intval($_GET['id']);
						$select_hospital = $bdd->prepare("SELECT * FROM hospital WHERE id_hospital=?");
						$select_hospital->execute(array($id));
						$count = $select_hospital->rowCount();
						
						//CONDICIÓN SI ES IGUAL A CERO REDIRECCIONA AL MANTENEDOR DE PERFILES.
						if($count == 0){

							header("Location: ../view_hospital.php");

						//EN CASO QUE EXISTA LLENA LOS INPUT PARA EDITAR.
						}else{

							$row = $select_hospital->fetch();
							
						}
			
					?>

			<!--FORMULARIO DE EDICIÓN-->
<form  action="hospital/hospitalUpdate.php" method="POST" autocomplete="off">
	            	<!--VARIABLE IDENTIFICADOR DE LOS REGISTROS-->
	            	<?php $id_hospital = $row['id_hospital']; ?>
	            <!--ENVÍA ID OCULTO-->
	<input type="hidden" name="id_hospital" value="<?php echo $id_hospital; ?>">

        <div class="input-group">
			<span class="input-group-addon" style="width:200px;">Nombre</span>
				<input type="text" name="nombre_hospital" class="form-control span6 tip" value="<?php echo $row['nombre_hospital']; ?>" style="width:400px;"  pattern="[A-Za-z ]{2,50}" maxlength="50"  title="Solo se aceptan letras. Longitud mínima de 2 a 50 caracteres." required>
		</div>

		<br>

		<div class="input-group">
			<span class="input-group-addon" style="width:200px;">Dirección</span>
				<input type="text" name="direccion_hospital" class="form-control span6 tip" value="<?php echo $row['direccion_hospital']; ?>" style="width:400px;"  pattern="[A-Za-z ]+[0-9]{2,50}" maxlength="50"  title="Solo se aceptan letras, números. Longitud mínima de 2 a 50 caracteres." required>
		</div>

		<br>

		<div class="input-group">
			<span class="input-group-addon" style="width:200px;">Teléfono</span>
				<input type="text" name="telefono_hospital" class="form-control span6 tip" value="<?php echo $row['telefono_hospital']; ?>" style="width:400px;"  pattern="[0-9]{7}" maxlength="7"  title="Solo se aceptan números de 7 dígitos." required>
		</div>

		<div class="control-group" style="margin-top: 5%;">
			<div class="controls">
                <button type="submit" name="form_hospital" class="btn btn-success">Guardar</button>
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