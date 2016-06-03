<?php 
require_once('inc/connect.php');
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$usertype = $_SESSION['usertype'];
$id = $_SESSION['id'];
$msg = "";
switch($usertype) {
	case 1:
		$query = "SELECT * FROM students WHERE id = '$id'";
		break;
	case 2:
		$query = "SELECT * FROM supervisors WHERE id = '$id'";
		break;
	case 3:
		$query = "SELECT * FROM lecturers WHERE id = '$id'";
		break;
	default:
		break;
}

$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
$id = $row['id'];
$username = $row['username'];
$fullName = $row['fullName'];

$oldEmp = $newEmp = $error = "";
$oldpass = $newpass = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST['oldpass'])) {
		$oldEmp = "Must filled in!";
		$error = 1;
	}
	else {
		$oldpass = md5($_POST['oldpass']);
	}
	
	if(empty($_POST['newpass'])) {
		$newEmp = "Must filled in!";
		$error = 1;
	}
	else {
		$newpass = md5($_POST['newpass']);
	}
	
	switch($usertype) {
		case 1:
			$user = "students";
			$query= "UPDATE students SET password = '$newpass' WHERE id = '$id'";
			break;
		case 2:
			$user = "supervisors";
			$query= "UPDATE supervisors SET password = '$newpass' WHERE id = '$id'";
			break;
		case 3:
			$user = "lecturers";
			$query= "UPDATE lecturers SET password = '$newpass' WHERE id = '$id'";
			break;
		default:
			break;
	}
	
	if(empty($error)) {
		$get_oldpass = mysqli_query($con, "SELECT password FROM $user WHERE id = '$id' AND password = '$oldpass'");
		$count = mysqli_num_rows($get_oldpass);
		if($count > 0) {
			$exec_update = mysqli_query($con, $query);
			$msg = "<font color=\"green\">Password Updated Successfully.</font>";
		}
		else {
			$msg = "<font color=\"red\">Update Failed! Old Password Does Not Match.</font>";
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
<title>e-Internship</title>
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-1.11.3.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
		$("#confirmpass").keyup(function() {
		var password = $("#newpass").val();
		var confirmPass = $("#confirmpass").val();

		if(password != confirmPass) {
			$("#checkPass").html("<font size=2px; color=\"red\">Password do not match!</font>");
		}
		else {
			$("#checkPass").html("<font size=2px; color=\"green\">Password match.</font>");
		}
	});
});
</script>
</head>
<body>
	<div id="SiteBody">
		<div id="header-form"></div>
		<div id="nav-left">
			<a href="menu.php" class="link"><img src="images/home.png" alt="home">
				<div class="title-left">
					Home
				</div>
			</a>
		</div>
		<div id="nav-right">
			<a href="#" class="link"><img src="images/profile.png" alt="profile" class="profile">
				<div class="title-med">My Profile</div>
			</a>
			<a href="logout.php" class="link"><img src="images/logout.png" alt="logout" class="logout">
				<div class="title-right">Logout</div>
			</a>
		</div>
		<div id="container">
			<div class="searchLog">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table>
						<th colspan="2"><div><?php echo $msg; ?></div>My Profile</th>
						<tr>
							<td>Username:</td>
							<td><?php echo $username; ?></td>
						</tr>
						<tr>
							<td>Full Name:</td>
							<td><?php echo $fullName; ?></td>
						</tr>
						<th colspan="2">Change Password</th>
						<tr>
							<td>Old Password:</td>
							<td><input type="password" name="oldpass" id="oldpass" />
							<span class="error"><?php echo $oldEmp; ?></span></td>
						</tr>
						<tr>
							<td>New Password:</td>
							<td><input type="password" name="newpass" id="newpass" />
							<span class="error"><?php echo $newEmp; ?></span></td>
						</tr>
						<tr>
							<td>Confirm Password:</td>
							<td><input type="password" name="confirmpass" id="confirmpass" />
							<span class="error"><?php echo $newEmp; ?></span><div id="checkPass"></div></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" name="submit" value="CHANGE PASSWORD">
							<input type="reset" name="reset" value="RESET"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>