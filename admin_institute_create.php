<?php 
require_once('inc/connect.php');
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$message = $appellationEmp = $error = "";
$user = "administrator";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST['appellation'])) {
		$appellationEmp = "Must filled in!";
		$error = 1;
	}
	else {
		$appellation = $_POST['appellation'];
	}
	
	if(empty($error)) 
	{
		$query = "INSERT INTO institute(appellation, DT_CREATE, IDENT) VALUES('$appellation', NOW(), '$user')";
						
		$result = mysqli_query($con, $query);
		
		if($result) {
			$message = "<font color=\"green\">Date Successfully Inserted Into Database.</font>";
		}
		else {
			$message = "<font color=\"red\">Insert Failed!</font>";
		}
	}
	else {
		$message =  "<font color=\"red\">Insert Failed!</font>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
<title>e-Internship</title>
<link rel="stylesheet" href="css/style.css">
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
			<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
				<table>
					<th colspan = "4"><div><?php echo $message; ?></div>Institute Create Form</th>
					<tr>
						<td>Appellation:</td>
						<td><input type="text" name="appellation" id="appellation" value="" />
						<span class="error"><?php echo $appellationEmp; ?></span></td>
					</tr>
					<tr>
						<td colspan="4"><center><input type="submit" value="SAVE" />
										<input type="reset" value="RESET"></center></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>