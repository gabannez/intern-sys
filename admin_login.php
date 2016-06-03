<?php
require_once('inc/connect.php');

session_start();

$userErr = $passErr = $msgErr = $error = "";
$username = $password = "";

if($_SERVER['REQUEST_METHOD']=='POST') {
	if(empty($_POST['username'])) {
		$userErr = "Username must be filled in.";
		$error = 1;
	}
	else {
		$username = $_POST['username'];
	}
		
	if(empty($_POST['password'])) {
		$passErr = "Password must be filled in.";
		$error = 1;
	}
	else {
		$password = md5($_POST['password']);
	}
	
	$username = mysqli_escape_string($con, $username);
	$password = mysqli_escape_string($con, $password);
	
	if(empty($error)) 
	{
		$result = mysqli_query($con, "SELECT `username`, `password` FROM `admin` WHERE `username` = '$username' AND `password` = '$password'");
		$count = mysqli_num_rows($result);
	
		if($count == 1) {
			$_SESSION['username'] = $username;
			$_SESSION['role'] = 10;
			$_SESSION['login_success'] = true;
			header('location: menu.php');
		}
		else {
			$msgErr = "Sorry, wrong login information.";
		}
	}
	else {
		$msgErr = "Sorry, wrong login information.";
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
						<table>
							<th colspan="2">Admininistrator Login</th>
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
								<td>&nbsp;</td>
								<td><input type="submit" value="Login" />
								<input type="reset" value="Reset" /></td>
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