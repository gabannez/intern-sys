<?php 
require_once('inc/connect.php');
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$id_del = trim($_GET['del']);

$query = "DELETE FROM state WHERE id = '$id_del'";
$result = mysqli_query($con, $query);

if($result)
{
	echo "Record Deleted Successfully.";
	header('Refresh: 3;url=admin_institute_list.php');
}
else 
{
	echo "Oops, There is problem in deleting the data.";
}

mysqli_close($con);

?>