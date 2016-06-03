<?php 

require_once('config.php');

$con = mysqli_connect($host, $user, $pass, $database);
	
if(!$con) {
	die('Connect Error: ' . mysqli_connect_error());
}

?>