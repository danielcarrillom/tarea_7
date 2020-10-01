<?php

/*CONEXIÓN A LA BD*/
require_once('conn.php');

include('sesion_full.php');

 
$requestData= $_REQUEST;

$columns = array( 

	0 =>'rut',
	1 =>'nombre',
	2 =>'apellidop',
	3 =>'apellidom',
	4 =>'telefono',
	5 =>'opciones',
);

/*CONSULTA SQL CON INNER JOIN*/
$sql = "SELECT * ";
$sql.="FROM hospital INNER JOIN funcionario ON hospital.id_hospital=funcionario.hospital_id_hospital INNER JOIN perfil ON perfil.id_perfil=funcionario.perfil_id_perfil";

$query=mysqli_query($conn, $sql) or die(mysqli_error());
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * ";
$sql.="FROM hospital INNER JOIN funcionario ON hospital.id_hospital=funcionario.hospital_id_hospital INNER JOIN perfil ON perfil.id_perfil=funcionario.perfil_id_perfil WHERE 1=1";

/*PERMITE REALIZAR LA BÚSQUEDA*/
if( !empty($requestData['columns'][0]['search']['value']) ){   
	$sql.=" AND rut_funcionario LIKE '".$requestData['columns'][0]['search']['value']."%' ";
}
if( !empty($requestData['columns'][1]['search']['value']) ){  
	$sql.=" AND nombre_funcionario LIKE '".$requestData['columns'][1]['search']['value']."%' ";
}
if( !empty($requestData['columns'][2]['search']['value']) ){  
	$sql.=" AND apellidop_funcionario LIKE '".$requestData['columns'][2]['search']['value']."%' ";
}

if( !empty($requestData['columns'][3]['search']['value']) ){  
	$sql.=" AND apellidom_funcionario LIKE '".$requestData['columns'][3]['search']['value']."%' ";
}

if( !empty($requestData['columns'][4]['search']['value']) ){  
	$sql.=" AND telefono_funcionario LIKE '".$requestData['columns'][4]['search']['value']."%' ";
}

/*ORDENA LOS REGISTROS*/
$query=mysqli_query($conn, $sql) or die(mysqli_error());
$totalFiltered = mysqli_num_rows($query); 
	
if($columns[$requestData['order'][0]['column']] != ''){

    $sql.=" ORDER BY rut_funcionario ASC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

}else{

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    
}

$query=mysqli_query($conn, $sql);

	$data = array();

	/*RECORRE LOS REGISTROS DE LA CONSULTA PARA MOSTRARLO EN EL MANTENEDOR*/
	while( $row=mysqli_fetch_array($query) ) { 

	$nestedData=array(); 

	$nestedData[] 	= $row["rut_funcionario"];
	$nestedData[] 	= $row["nombre_funcionario"];
	$nestedData[] 	= $row["apellidop_funcionario"]." ".$row["apellidom_funcionario"];
	$nestedData[] 	= $row["telefono_funcionario"];
	$nestedData[] 	= $row["nombre_hospital"];

	/*CONDICIÓN PARA CAMBIAR EL NOMBRE A TIPO PERFIL Y MOSTRAR AL USUARIO*/
	if ($row["tipo_perfil"] == 'Limited') {
		
		$nestedData[] 	= "Limitado";

	}else{

		$nestedData[] 	= "Completo";
	}

	/*ENVÍA POR URL EL RUT A PÁGINA PARA EDITAR FUNCIONARIO*/
	$nestedData[] = "<td>
					<center><a href='sc/funcionarioEdit.php?id=".$row['rut_funcionario']."' target='_blank' class='btn btn-warning'><i class='fas fa-edit'></i></a>";

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