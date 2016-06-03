<?php
require_once('inc/connect.php');
session_start();

$user = $_SESSION['username'];
$id_student = $_SESSION['id'];

$date = $_REQUEST['date'];
$day = $_REQUEST['day'];
$task_activities = $_REQUEST['task_activities'];
$remarks = $_REQUEST['remarks'];

$sql = "INSERT INTO logbook(id_student,date,day,task_activities,remarks,DT_CREATE,IDENT) 
		VALUES('$id_student','$date','$day','$task_activities','$remarks',NOW(),'$user')";
mysqli_query($con,$sql);

echo json_encode(array(
	'id' => mysqli_insert_id(),
	'date' => $date,
	'day' => $day,
	'task_activities' => $task_activities,
	'remarks' => $remarks,
	'DT_CREATE' => NOW(),
	'IDENT' => $user
));

?>