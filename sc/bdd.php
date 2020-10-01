<?php

try

{
	$bdd = new PDO('mysql:host = localhost; dbname = seguimiento_covid19; charset = utf8', 'root', 'admin2020covidA');
}

catch(Exception $e)
{

    die('Error : '.$e->getMessage());

}

?>

