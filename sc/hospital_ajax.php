<?php
/*CONEXIÓN A LA BD*/
require_once('conn.php');

include('sesion_full.php');
 
$requestData= $_REQUEST;

$columns = array( 

	0 =>'nombre',
	1 =>'direccion',
	2 =>'telefono',
	3 =>'opciones',
);

/*CONSULTA SQL*/
$sql = "SELECT * ";
$sql.="FROM hospital";

$query=mysqli_query($conn, $sql) or die(mysqli_error());
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * ";
$sql.="FROM hospital WHERE 1=1";

/*PERMITE REALIZAR LA BÚSQUEDA*/
if( !empty($requestData['columns'][0]['search']['value']) ){   
	$sql.=" AND nombre_hospital LIKE '".$requestData['columns'][0]['search']['value']."%' ";
}
if( !empty($requestData['columns'][1]['search']['value']) ){  
	$sql.=" AND direccion_hospital LIKE '".$requestData['columns'][1]['search']['value']."%' ";
}
if( !empty($requestData['columns'][2]['search']['value']) ){  
	$sql.=" AND telefono_hospital LIKE '".$requestData['columns'][2]['search']['value']."%' ";
}

/*ORDENA LOS REGISTROS*/
$query=mysqli_query($conn, $sql) or die(mysqli_error());
$totalFiltered = mysqli_num_rows($query); 
	
if($columns[$requestData['order'][0]['column']] != ''){

    $sql.=" ORDER BY nombre_hospital ASC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

}else{

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    
}

$query=mysqli_query($conn, $sql);

	$data = array();

	/*RECORRE LOS REGISTROS DE LA CONSULTA PARA MOSTRARLO EN EL MANTENEDOR*/
	while( $row=mysqli_fetch_array($query) ) { 

	$nestedData=array(); 

	$nestedData[] 	= $row["nombre_hospital"];
	$nestedData[] 	= $row["direccion_hospital"];
	$nestedData[] 	= $row["telefono_hospital"];

	/*ENVÍA POR URL EL ID A PÁGINA PARA EDITAR HOSPITAL*/
	$nestedData[] = "<td>
					<center><a href='sc/hospitalEdit.php?id=".$row['id_hospital']."' target='_blank' class='btn btn-warning'><i class='fas fa-edit'></i></a>";

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