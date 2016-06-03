<?php
require_once('inc/connect.php');
session_start();

$id = $_SESSION['id'];
$usertype = $_SESSION['usertype'];
if($usertype > 1) {
	$rs = mysqli_query($con, "SELECT * FROM logbook");
} else {
	$rs = mysqli_query($con, "SELECT * FROM logbook WHERE id_student='$id'");
}
$result = array();
while($row = mysqli_fetch_object($rs)){
	array_push($result, $row);
}
echo json_encode($result);

?>