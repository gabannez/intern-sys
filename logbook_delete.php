<?php
require_once('inc/connect.php');

$id = intval($_REQUEST['id']);

$sql = "DELETE FROM logbook where id='$id'";
@mysqli_query($con, $sql);
echo json_encode(array('success'=>true));
?>