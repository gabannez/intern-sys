<?php 
require_once('inc/connect.php');
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$id_edit = $_GET['edit'];
$user = "administrator";

$sql = "SELECT * FROM major WHERE id = '$id_edit'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$id = $row['id'];
$appellation = $row['appellation'];

$message = $appellationEmp = $error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$id_edit = $_GET['edit'];
	if(empty($_POST['appellation'])) {
		$appellationEmp = "Must filled in!"; 
		$error = 1;
	}
	else {
		$appellation = $_POST['appellation'];
	}
	
	if(empty($error)) {
		$sql = "UPDATE major SET appellation = '$appellation', DT_CREATE = NOW(), IDENT = '$user' WHERE id = '$id_edit'";
		$result = mysqli_query($con, $sql);
		
		if($result) {
			$message = "<font color=\"green\">* Data Updated Successfully.</font>";
		}
		else {
			$message = "<font color=\"red\">* Update Failed!.</font>";
		}
	}
	else {
		$message = "<font color=\"red\">* Update Failed!.</font>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
<title>e-Internship</title>
<link rel="stylesheet" href="/eintern/css/style.css">
</head>
<body>
	<div id="SiteBody">
		<div id="header-form"></div>
		<div id="nav-left">
				<a href="menu.php" class="link"><img src="/eintern/images/home.png" alt="home">
					<div class="title-left">
						Home
					</div>
				</a>
		</div>
		<div id="nav-right">
			<a href="#" class="link"><img src="/eintern/images/profile.png" alt="profile" class="profile">
				<div class="title-med">My Profile</div>
			</a>
			<a href="logout.php" class="link"><img src="/eintern/images/logout.png" alt="logout" class="logout">
				<div class="title-right">Logout</div>
			</a>
		</div>
		<div id="container">
			<form method="post" action="<?php echo "admin_major_update.php?edit=$id_edit"; ?>">
				<table>
					<th colspan = "4"><div><?php echo $message; ?></div>Major Update Form</th>
					<tr>
						<td>Appellation: *</td>
						<td><input type="text" name="appellation" id="appellation" value="<?php echo $appellation; ?>" />
						<span class="error"><?php echo $appellationEmp; ?></span></td>
					</tr>
					<tr>
						<td colspan="4"><center><input type="submit" value="UPDATE" />
										<input type="reset" value="RESET" /></center></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>