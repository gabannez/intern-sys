<?php 
require_once('inc/connect.php');
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$message = $userEmp = $passEmp = $nameEmp = $icEmp = $error = "";
$user = "administrator";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST['username'])) {
		$userEmp = "Must filled in username!";
		$error = 1;
	}
	else {
		$username = $_POST['username'];
	}
	if(empty($POST['password'])) {
		$passEmp = "Must filled in password!";
		$error = 1;
	}
	else {
		$password = md5($_POST['password']);
	}
	if(empty($_POST['fullName'])) {
		$nameEmp = "Must filled in full name!";
		$error = 1;
	}
	else {
		$fullName = $_POST['fullName'];
	}
	if(empty($_POST['ic'])) {
		$icEmp = "Must filled in IC!";
		$error = 1;
	}
	else {
		$ic = $_POST['ic'];
	}

	$position = $_POST['position'];
	$gender = $_POST['gender'];
	$nationality = $_POST['nationality'];
	$compName = $_POST['comp_name'];
	$compAddress = $_POST['comp_address'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$officeNo = $_POST['officeNo'];
	$email = $_POST['email'];
	$mobileNo = $_POST['mobileNo'];
	
	if(empty($error)) {
		$query = "INSERT INTO supervisors(username, password, fullName, ic, position, gender, nationality, compName, address, state, postcode, officeNo, email, mobileNo, DT_CREATE, IDENT)
				 VALUES('$username', '$password', '$fullName', '$ic', '$position', '$gender', '$nationality', '$compName', '$compAddress', '$state', '$postcode',
						'$officeNo', '$email', '$mobileNo', NOW(), '$user')";			 

		if(mysqli_query($con, $query)) {
			$message = "<font color=\"green\">* Data Successfully Inserted Into Database.</font>";
		}
		else {
			$message = "<font color=\"red\">Insert Failed!.</font>";
		}
	}
	else {
		$message = "<font color=\"red\">Insert Failed!.</font>";
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
<title>e-Internship</title>
<link rel="stylesheet" href="/eintern/css/style.css">
<script src="js/jquery-1.11.3.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
		$("#confirm").keyup(function() {
		var password = $("#password").val();
		var confirmPass = $("#confirm").val();

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
	<form method="post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<table>
			<th colspan="4"><div><?php echo $message; ?></div>Supervisor Registration Form</th>
			<tr>
				<td><font color="red">Username:* </font></td>
				<td colspan="3"><input type="text" name="username" id="username" value="" />
				<span class="error"><?php echo $userEmp; ?></span></td>
			</tr>
			<tr>
				<td><font color="red">Password:* </font></td>
				<td colspan="3"><input type="password" name="password" id="password" value="" />
				<span class="error"><?php echo $passEmp; ?></span></td>
			</tr>
			<tr>
				<td><font color="red">Confirm Password:* </font></td>
				<td colspan="3"><input type="password" name="confirm" id="confirm" value="" /><div id="checkPass"></div></td>
			</tr>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="fullName" id="fullName" value="" />
				<span class="error"><?php echo $nameEmp; ?></span></td>
				<td>Identity Card No:</td>
				<td><input type="text" name="ic" id="ic" value="" /></td>
			</tr>
			<tr>
				<td>Position:</td>
				<td><input type="text" name="position" id="position" value="" /></td>
				<td>Gender:</td>
				<td><select style="width:92%;" name="gender">
						<option value="0">--SELECT--</option>
						<option value="1">Male</option>
						<option value="2">Female</option>
					</select></td>
			</tr>
			<tr>
				<td>Nationality:</td>
				<td><input type="text" name="nationality" id="nationality" value="Malaysia" readonly /></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<th colspan = "4">Company Address Information</td>
			<tr>
				<td>Company Name:</td>
				<td><input type="text" name="comp_name" id="comp_name" value="" /></td>
				<td colspan="2" rowspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><textarea rows="3" cols="30" wrap="hard" name="comp_address"></textarea></td>
			</tr>
			<tr>
				<td>State:</td>
				<td><select style="width:92%;" name="state">
						<option value="0">--SELECT--</option>
						<?php 
							$state_query = "SELECT * FROM state";
							$result = mysqli_query($con, $state_query);
							while($row = mysqli_fetch_array($result))
							{
								echo '<option value="'.$row['id'].'">'.$row['appellation'].'</option>';
							}
						?>
					</select>
				</td>
				<td>Postcode:</td>
				<td><input type="text" name="postcode" id="postcode" value="" /></td>
			</tr>
			<th colspan="4">Contact Information</th>
			<tr>
				<td>Office(Tel):</td>
				<td><input type="text" name="officeNo" id="officeNo" value="" /></td>
				<td>Email:</td>
				<td><input type="text" name="email" id="email" value="" /></td>
			</tr>
			<tr>
				<td>Mobile No:</td>
				<td><input type="text" name="mobileNo" id="mobileNo" value="" /></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4"><center><input type="submit" value="SAVE" onclick="" />
								<input type="reset" value="RESET"></center></td>
			</tr>
		</table>
	</form>
	</div>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>