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
	5 =>'direccion',
	6 =>'opciones',
);

/*CONSULTA SQL*/
$sql = "SELECT * ";
$sql.="FROM paciente";

$query=mysqli_query($conn, $sql) or die(mysqli_error());
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * ";
$sql.="FROM paciente WHERE 1=1";

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

if( !empty($requestData['columns'][4]['search']['value']) ){  
	$sql.=" AND telefono_paciente LIKE '".$requestData['columns'][4]['search']['value']."%' ";
}

if( !empty($requestData['columns'][5]['search']['value']) ){  
	$sql.=" AND direccion_paciente LIKE '".$requestData['columns'][5]['search']['value']."%' ";
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
	$nestedData[] 	= $row["nombre_paciente"];
	$nestedData[] 	= $row["apellidop_paciente"]." ".$row["apellidom_paciente"];
	$nestedData[] 	= $row["telefono_paciente"];
	$nestedData[] 	= $row["direccion_paciente"];

	/*ENVÍA POR URL EL RUT A PÁGINA PARA EDITAR Y ELIMINAR PACIENTE*/
	$nestedData[] = "<td>
					<center><a href='sc/pacienteEdit.php?id=".$row['rut_paciente']."' target='_blank' class='btn btn-warning'><i class='fas fa-edit'></i></a>

					
					<a href='sc/paciente/pacienteDelete.php?id=".$row['rut_paciente']."' target='_blank' class='btn btn-danger'><i class='fas fa-trash'></i></a></td></center>";

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