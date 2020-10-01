<?php

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=reporte_bitacora.xls");

require('../bdd.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bitácora</title>
</head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>

<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="6"><CENTER><strong>REGISTRO DE MOVIMIENTOS BITÁCORA</strong></CENTER></td>
    <td colspan="2"><CENTER><strong>Solicitud <?php echo $fecha = date('d-m-Y'); ?></strong></CENTER></td>
  </tr>
  <tr>
  	<td><strong>N°</strong></td>
    <td><strong>USUARIO RESPONSABLE</strong></td>
    <td><strong>PERFIL RESPONSABLE</strong></td>
    <td><strong>TIPO MOVIMIENTO</strong></td>
    <td><strong>DESCRIPCIÓN MOVIMIENTO</strong></td>
    <td><strong>FECHA MOVIMIENTO</strong></td>
    <td><strong>REPORTE DESDE</strong></td>
    <td><strong>REPORTE HASTA</strong></td>
  </tr>
  
<?PHP
	
if (isset($_POST['buscar_entre_fechas'])) {

//RECIBE CAMPOS Y LOS GUARDA EN VARIABLE

$fecha_inicio 	= date("Y-m-d",strtotime($_POST["from"]));
$fecha_fin		= date("Y-m-d",strtotime($_POST["to"]));
$numero			= 1;
//CONSULTA POR RANGO DE FECHA
$select_bitacora = $bdd->prepare("SELECT * FROM movimiento_bitacora WHERE fecha_movimiento BETWEEN ? AND ? "); 
$select_bitacora->execute(array($fecha_inicio, $fecha_fin));


//GUARDA EN VARIABLE LA COINCIDENCIA ENCONTRADA
while ($row = $select_bitacora->fetch()){

		
	$nombre_usuario			=$row["nombre_usuario"];

	if ($row["tipo_usuario"] == 'Full') {
		
		$tipo_usuario = 'Completo';

	}else{

		$tipo_usuario = 'Limitado';
	}

	$tipo_movimiento 		=$row["tipo_movimiento"];
	$descripcion_movimiento	=$row["descripcion_movimiento"];
	$fecha_movimiento		=$row["fecha_movimiento"];
	
 ?>
 

 <tr>
 	<td><?php echo $numero; ?></td>
 	<td><?php echo $nombre_usuario; ?></td>
	<td><?php echo $tipo_usuario; ?></td>
	<td><?php echo $tipo_movimiento; ?></td>
	<td><?php echo $descripcion_movimiento; ?></td>
	<td><?php echo $fecha_movimiento; ?></td>
	<td><?php echo $fecha_inicio; ?></td>
	<td><?php echo $fecha_fin; ?></td>
	                    
 </tr> 

<?php

$numero++;

}

}

?>  
</table>
</body>
</html>