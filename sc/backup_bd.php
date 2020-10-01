
<?php
	
	include('sc/sesion_full.php');

	//Datos de eonexión
	$host 		= 'localhost'; 
	$nombre_bd 	= 'tarea_2'; 
	$usuario 	= 'root'; 
	$clave 		= ''; 
	
	//Variable que asigna el nombre al archivo a exportar
	$fecha = date("Ymd-His");
	$backup_sql = $nombre_bd.'_'.$fecha.'.sql'; 
	
	//Conexión a mysqldump.exe y se le pasan las variables de conexión
	$dump = "C:\\xampp\\mysql\\bin\\mysqldump.exe  -u $usuario --password=$clave --opt $nombre_bd > $backup_sql";
	system($dump, $output);
	
	//Se genera el archivo comprimido en formato zip
	$zip = new ZipArchive();
	$salida_zip = $nombre_bd.'_'.$fecha.'.zip';
	
	//Condición que genera el archivo
	if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true) { 
		$zip->addFile($backup_sql);
		$zip->close(); 
		unlink($backup_sql);
		header ("Location: $salida_zip"); 
		} else {
	}
	
?>
