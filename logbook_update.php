<?php
require_once('inc/connect.php');
session_start();

$id = intval($_REQUEST['id']);
$user = $_SESSION['username'];
$id_student = $_SESSION['id'];

$date = $_REQUEST['date'];
$day = $_REQUEST['day'];
$task_activities = $_REQUEST['task_activities'];
$remarks = $_REQUEST['remarks'];

$sql = "UPDATE logbook SET id_student = '$id_student',date='$date',day='$day',task_activities='$task_activities',remarks='$remarks',DT_CREATE=NOW(), IDENT='$user' WHERE id='$id'";
@mysqli_query($con,$sql);
echo json_encode(array(
	'date' => $date,
	'day' => $day,
	'task_activities' => $task_activities,
	'DT_CREATE' => NOW(),
	'IDENT' => $user
));
?>