<?php
/*CONEXIÓN A LA BD*/
require_once('conn.php');

include('sesion_limited.php');

$requestData= $_REQUEST;

$columns = array( 

	0 =>'rut',
	1 =>'nombre',
	2 =>'direccion',
	3 =>'supervisor',
	4 =>'estado',
	5 =>'opciones',
);

/*CONSULTA SQL CON INNER JOIN*/
$sql = "SELECT id_historial_clinico, rut_paciente, nombre_paciente, apellidop_paciente, apellidom_paciente, direccion_paciente, nombre_funcionario, apellidop_funcionario, apellidom_funcionario, estado ";
$sql.="FROM funcionario INNER JOIN supervisa ON funcionario.rut_funcionario=supervisa.funcionario_rut_funcionario INNER JOIN paciente ON supervisa.paciente_rut_paciente=paciente.rut_paciente INNER JOIN historial_clinico ON paciente.rut_paciente=historial_clinico.paciente_rut_paciente";

$query=mysqli_query($conn, $sql) or die(mysqli_error());
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT id_historial_clinico, rut_paciente, nombre_paciente, apellidop_paciente, apellidom_paciente, direccion_paciente, nombre_funcionario, apellidop_funcionario, apellidom_funcionario, estado ";
$sql.="FROM funcionario INNER JOIN supervisa ON funcionario.rut_funcionario=supervisa.funcionario_rut_funcionario INNER JOIN paciente ON supervisa.paciente_rut_paciente=paciente.rut_paciente INNER JOIN historial_clinico ON paciente.rut_paciente=historial_clinico.paciente_rut_paciente WHERE 1=1";

/*PERMITE REALIZAR LA BÚSQUEDA*/
if( !empty($requestData['columns'][0]['search']['value']) ){   
	$sql.=" AND rut_paciente LIKE '".$requestData['columns'][0]['search']['value']."%' ";
}
if( !empty($requestData['columns'][1]['search']['value']) ){  
	$sql.=" AND nombre_paciente LIKE '".$requestData['columns'][1]['search']['value']."%' ";
}
if( !empty($requestData['columns'][2]['search']['value']) ){  
	$sql.=" AND apellidop_paciente LIKE '".$requestData['columns'][2]['search']['value']."%' ";
}
if( !empty($requestData['columns'][3]['search']['value']) ){  
	$sql.=" AND apellidom_paciente LIKE '".$requestData['columns'][3]['search']['value']."%' ";
}


/*ORDENA LOS REGISTROS*/
$query=mysqli_query($conn, $sql) or die(mysqli_error());
$totalFiltered = mysqli_num_rows($query); 
	
if($columns[$requestData['order'][0]['column']] != ''){

    $sql.=" ORDER BY rut_paciente ASC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

}else{

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    
}

$query=mysqli_query($conn, $sql);

	$data = array();

	/*RECORRE LOS REGISTROS DE LA CONSULTA PARA MOSTRARLO EN EL MANTENEDOR*/
	while( $row=mysqli_fetch_array($query) ) { 

	$nestedData=array(); 

	$nestedData[] 	= $row["rut_paciente"];
	$nestedData[] 	= $row["nombre_paciente"]." ".$row["apellidop_paciente"]." ".$row["apellidom_paciente"];
	$nestedData[] 	= $row["direccion_paciente"];
	$nestedData[] 	= $row["nombre_funcionario"]." ".$row["apellidop_funcionario"]." ".$row["apellidom_funcionario"];

	/*MUESTRA EL ESTADO EN UN SPAN DE COLOR*/
	if ($row["estado"] == 'Activo') {

		$nestedData[]   = "<center><span class='label label-warning'>Activo</span></center>";

	}else{

		$nestedData[]   = "<center><span class='label label-success'>Finalizado</span></center>";

	}	

	/*ENVÍA POR URL EL ID A PÁGINA PARA EDITAR Y ELIMINAR HISTORIAL CLÍNICO*/
	$nestedData[] = "<td>
					<center><a href='sc/historial_clinicoEdit_ltd.php?id=".$row['id_historial_clinico']."' target='_blank' class='btn btn-warning'><i class='fas fa-edit'></i></a>
					
					<a href='sc/detail_historial_clinico_ltd.php?id=".$row['id_historial_clinico']."' target='_blank' class='btn btn-info'><i class='fas fa-eye'></i></a></td></center>";

	$data[] = $nestedData;
	
}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),  
			"recordsTotal"    => intval( $totalData ),  
			"recordsFiltered" => intval( $totalFiltered ), 
			"data"            => $data   
			);

echo json_encode($json_data);  

?>