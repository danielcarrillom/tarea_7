<?php
include('sesion_limited.php');
?>

<!DOCTYPE html>
<html>
<head>
   <title>Detalle Historial Clínico</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="../media/font_awesome/css/all.css" rel="stylesheet">
<link href="../css/custom_timeline.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../css/info.css" rel="stylesheet">
<!--Panel-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<?php

//Conexión a la base de datos.
require_once('bdd.php');

$id_historial   = intval($_GET['id']);


$select_historial = $bdd->prepare("SELECT * FROM funcionario INNER JOIN supervisa ON funcionario.rut_funcionario=supervisa.funcionario_rut_funcionario INNER JOIN paciente ON supervisa.paciente_rut_paciente=paciente.rut_paciente INNER JOIN historial_clinico ON paciente.rut_paciente=historial_clinico.paciente_rut_paciente INNER JOIN hospital ON hospital.id_hospital=funcionario.hospital_id_hospital WHERE id_historial_clinico=?"); 

$select_historial->execute(array($id_historial));

$row = $select_historial->fetch();

?>

<body>

<div id="content_sesion_fll">
   <div id="content_user"><i class="fas fa-user"></i> Perfil Administrador</div>
         <div id="content_logout">
            <form method='POST'>
               <i class="fas fa-sign-out-alt"></i><button class="button_login" id='salir' name='salir' value='1'>Cerrar Sesión</button>
            </form>
   </div>
</div>


<div class="container" style="margin-bottom: 1%;">
      <br>
      <h2 class="text-center m-1"><?php echo $row["nombre_hospital"]; ?></h2>
        <div class="row b-t pt-8">
          <div class="col-md-6 pt-6 center">
            <h4 class="title_timeline"></h4>
          </div>
        </div>
</div>


                    <div class="container" style="width: 60%;">
                      <div class="panel-group">

                        <div class="panel panel-info">
                          <div class="panel-heading">Detalle síntomas en los últimos 14 días.</div>
                          <div class="panel-body">                      
                            <h4><b><?php echo $row["nombre_paciente"]." ".$row["apellidop_paciente"]." ".$row["apellidom_paciente"]; ?></b></h4>
                            <h5><b>Rut: </b><?php echo $row["rut_paciente"]; ?></h5>
                            <h5><b>Teléfono: </b><?php echo $row["telefono_paciente"]; ?></h5>
                            <h5><b>Dirección: </b><?php echo $row["direccion_paciente"]; ?></h5>
                            <h5><b>Fecha Ingreso: </b><?php echo date("d-m-Y",strtotime($row["fecha_ingreso"])); ?></h5>

                            <br>
                            <h5><b>Seguimiento paciente: </b></h5>
                            
                            <h5><b>Observación Preliminar: </b><?php echo $row["observacion_preliminar"]; ?></h5>

                            <?php

                            $select_h_llamado = $bdd->prepare("SELECT fecha_hora_llamada, observacion_llamada, historial_clinico_id_historial_clinico FROM historial_llamada INNER JOIN historial_clinico ON historial_clinico.id_historial_clinico=historial_llamada.historial_clinico_id_historial_clinico WHERE id_historial_clinico=?"); 

                            $select_h_llamado->execute(array($id_historial));
                            $count = $select_h_llamado->rowCount();

                            echo "<br>";

                            echo "<h5><b>Historial Llamados</b></h5>";
                            
                            if ($count >= 1) {
                              
                              while ($row_llamado = $select_h_llamado->fetch()){

                                list($fecha, $hora) = explode(" ",$row_llamado["fecha_hora_llamada"]);

                                echo date("d-m-Y",strtotime($fecha))." a las ".$hora." / ".$row_llamado["observacion_llamada"];
                                echo "<br>";

                              }


                            }else{

                              echo "<h5>No existe observación adicional.</h5>";

                            }


                            echo "<br>";


                            if ($row["estado"] == 'Activo') {

                              echo "<span class='label label-warning'>Activo</span>";

                            }else{
                                
                                echo "<span class='label label-success'>Finalizado</span>";
                                
                            }

                            ?>

                            <br>
                            <br>
                            
                          
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>



</body>
</html>