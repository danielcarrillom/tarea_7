<?php

//MySQLi Procedural
$conn = mysqli_connect("localhost","root","admin2020covidA","seguimiento_covid19");

mysqli_set_charset($conn,"utf8");

if (!$conn) {

	die("Connection failed: " . mysqli_connect_error());
}

?>