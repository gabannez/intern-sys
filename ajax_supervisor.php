<?php 
include("inc/connect.php");
if($_POST['id'] == 0) {
	
	$array = array(
		'sName' => '', 
		'sAddress' => '', 
		'officeNo' => ''
	);
	
	echo json_encode($array);
}
else {
	$id = $_POST['id'];
	$sql = mysqli_query($con, "SELECT fullName, address, officeNo FROM supervisors WHERE id = '$id'");
	$row = mysqli_fetch_array($sql);
	
	$array = array(
		'sName' => $row['fullName'], 
		'sAddress' => $row['address'], 
		'officeNo' => $row['officeNo']
	);
	
	echo json_encode($array);
}

?>