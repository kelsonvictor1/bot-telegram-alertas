<?php
// configuration
$dbtype		= "mysql";
$dbhost 	= "mysql.hostinger.com.br";
$dbname		= "u487330816_banco";
$dbuser		= "u487330816_banco";
$dbpass		= "NGnaRDxbAfC7";

// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );

?>
