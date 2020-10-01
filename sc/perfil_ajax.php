<?php

/*CONEXIÓN A LA BD*/
require_once('conn.php');

include('sesion_full.php');
 
$requestData= $_REQUEST;

$columns = array( 

	0 =>'usuario',
	1 =>'tipo_perfil',
	2 =>'opciones',
);

/*CONSULTA SQL*/
$sql = "SELECT * ";
$sql.="FROM perfil";


$query=mysqli_query($conn, $sql) or die(mysqli_error());
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  


$sql = "SELECT * ";
$sql.="FROM perfil WHERE 1=1";

/*PERMITE REALIZAR LA BÚSQUEDA*/
if( !empty($requestData['columns'][0]['search']['value']) ){   
	$sql.=" AND usuario LIKE '".$requestData['columns'][0]['search']['value']."%' ";
}

if( !empty($requestData['columns'][1]['search']['value']) ){  
	$sql.=" AND tipo_perfil LIKE '".$requestData['columns'][2]['search']['value']."%' ";
}

/*ORDENA LOS REGISTROS*/
$query=mysqli_query($conn, $sql) or die(mysqli_error());
$totalFiltered = mysqli_num_rows($query); 
	
if($columns[$requestData['order'][0]['column']] != ''){

    $sql.=" ORDER BY usuario ASC  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

}else{

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    
}

$query=mysqli_query($conn, $sql);

	$data = array();

	/*RECORRE LOS REGISTROS DE LA CONSULTA PARA MOSTRARLO EN EL MANTENEDOR*/
	while( $row=mysqli_fetch_array($query) ) { 

	$nestedData=array(); 

	$nestedData[] 	= $row["usuario"];
	
	/*CONDICIÓN PARA CAMBIAR EL NOMBRE A TIPO PERFIL Y MOSTRAR AL USUARIO*/
	if ($row["tipo_perfil"] == 'Limited') {
		
		$nestedData[] 	= "Limitado";

	}else{

		$nestedData[] 	= "Completo";
	}

	$nestedData[] 	= date("d-m-Y",strtotime($row['fecha_creacion']));

	/*ENVÍA POR URL EL ID A PÁGINA PARA EDITAR PERFIL*/
	$nestedData[] = "<td>
					<center><a href='sc/perfilEdit.php?id=".$row['id_perfil']."' target='_blank' class='btn btn-warning'><i class='fas fa-edit'></i></a>";
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