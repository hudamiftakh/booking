<?php 
$serverName = "172.18.254.82";
$userName   = "huda_dinsos";
$password   = "huda_dinsos@2024";
$port   = "5432";
$dbName   = "sigamis";

$connString = "host=$serverName port=$port dbname=$dbName user=$userName password=$password";
// Create the Database Connection
$connId = pg_connect($connString);

var_dump($connId);