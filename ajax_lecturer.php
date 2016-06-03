<?php
include("inc/connect.php");
if($_POST['id'] == 0) {
	
	$array = array(
		'ic' => '',
		'lAddress' => '',
		'lContact' => '',
		'email' => ''
	);
	
	echo json_encode($array);
}
else {
	$id = $_POST['id'];
	$sql = mysqli_query($con, "SELECT ic, address, officeNo, email FROM lecturers WHERE id = '$id'");
	$row = mysqli_fetch_array($sql);
	
	$array = array(
		'ic' => $row['ic'],
		'lAddress' => $row['address'],
		'lContact' => $row['officeNo'],
		'email' => $row['email']
	);
	
	echo json_encode($array);
}
?>