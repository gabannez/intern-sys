<?php
require_once('inc/connect.php');

session_start();

$userErr = $passErr = $typeErr = $msgErr = $queryErr = "";
$username = $password = "";

if($_SERVER['REQUEST_METHOD']=='POST') {
	if(empty($_POST['username'])) {
		$userErr = "Username must be filled in.";
	}
	else {
		$username = $_POST['username'];
	}
		
	if(empty($_POST['password'])) {
		$passErr = "Password must be filled in.";
	}
	else {
		$password = md5($_POST['password']);
	}
	
	$username = mysqli_escape_string($con, $username);
	$password = mysqli_escape_string($con, $password);

	if(isset($_POST['userType'])) {
		$userType = $_POST['userType'];
		switch($userType) {
			case 0:
				$typeErr = "User type required.";
				break;
			case 1:
				$query = "SELECT `id`, `username`, `password`, `fullName` FROM `students` WHERE `username` = '$username' AND `password` = '$password'";
				break;
			case 2:
				$query = "SELECT `id`, `username`, `password`, `fullName` FROM `supervisors` WHERE `username` = '$username' AND `password` = '$password'";
				break;
			case 3:
				$query = "SELECT `id`, `username`, `password`, `fullName` FROM `lecturers` WHERE `username` = '$username' AND `password` = '$password'";
				break;
			default:
				break;
		}
	}
	
	if(empty($query)) 
	{
		$queryErr = "You must select the user type from drop-down list.";
	}
	else {
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		$count = mysqli_num_rows($result);
	
		if($count == 1) {
			$_SESSION['id'] = $row['id']; 
			$_SESSION['fullname'] = $row['fullName'];
			$_SESSION['username'] = $username;
			$_SESSION['usertype'] = $userType;
			$_SESSION['login_success'] = true;
			header('location: menu.php');
		}
		else {
			$msgErr = "Sorry, wrong login information.";
		}
	}

mysqli_close($con);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>e-Internship</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div id="SiteBody">
		<div id="header"></div>
		<div class="container">
			<div id="content">
				<form method = "post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
					<center>
						<span class="error"><?php echo $msgErr; ?></span>
						<span class="error"><?php echo $queryErr; ?></span>
						<table>
							<th colspan="2">Login Form</th>
							<tr>
								<td>Username</td>
								<td><input type="text" name="username" placeholder="Username" maxlength="50" autocomplete="off" />
									<span class="error"><?php echo $userErr; ?></span></td>
							</tr>
							<tr>
								<td>Password</td>
								<td><input type="password" name="password" placeholder="Password" maxlength="30" />
									<span class="error"><?php echo $passErr; ?></span></td>
							</tr>
							<tr>
								<td>User Type</td>
								<td><select style="width:91%;" name="userType">
										<option value="0">--SELECT--</option>
										<option value="1">Student</option>
										<option value="2">Supervisor</option>
										<option value="3">Lecturer</option>
									</select>
									<br /><span class="error"><?php echo $typeErr; ?></span>
								</td>
							</tr>
							<tr>
								<td rowspan="2">&nbsp;</td>
								<td><input type="submit" value="Login" />
								<input type="reset" value="Reset" /></td>
							</tr>
							<tr>
								<td><a href="#" alt="forgot_pass" class="forgot">Forgot Password?</a></td>
							</tr>
						</table>
					</center>
				</form>
			</div>
		</div>
		<div id="footer"><center><p>e-Internship @ 2015</p></center></div>
	</div>
</body>
</html>