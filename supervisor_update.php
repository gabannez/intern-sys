<?php 
require_once('inc/connect.php');
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$id_edit = $_GET['edit'];
$user = "administrator";

$sql = "SELECT * FROM supervisors WHERE id = '$id_edit'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$id = $row['id'];
$username = $row['username'];
$password = $row['password'];
$fullName = $row['fullName'];
$ic = $row['ic'];
$position = $row['position'];
$gender = $row['gender'];
$nationality = $row['nationality'];
$compName = $row['compName'];
$address =  $row['address'];
$state = $row['state'];
$postcode = $row['postcode'];
$officeNo = $row['officeNo'];
$email = $row['email'];
$mobileNo = $row['mobileNo'];

$message = $nameEmp = $icEmp = $error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$id_edit = $_GET['edit'];
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
	$username = $_POST['username'];
	$password = $_POST['password'];
	$position = $_POST['position'];
	$gender = $_POST['gender'];
	$nationality = $_POST['nationality'];
	$compName = $_POST['compName'];
	$address =  $_POST['address'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$officeNo = $_POST['officeNo'];
	$email = $_POST['email'];
	$mobileNo = $_POST['mobileNo'];
	
	if(empty($error)) {
		$sql = "UPDATE supervisors SET username = '$username', password = '$password', fullName = '$fullName', ic = '$ic', position = '$position', gender = '$gender',
		        nationality = '$nationality', compName = '$compName', address = '$address', state = '$state', postcode = '$postcode', officeNo = '$officeNo',
				email = '$email', mobileNo = '$mobileNo', DT_CREATE = NOW(), IDENT = '$user' WHERE id = '$id_edit'";
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
	<form method = "post" action = "<?php echo "supervisor_update.php?edit=$id_edit"; ?>">
		<table>
			<th colspan = "4"><div><?php echo $message; ?></div>Supervisor Registration Form</th>
			<tr>
				<td>Username:</td>
				<td colspan="3"><input type="text" name="username" id="username" value="<?php echo $username; ?>" readonly /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td colspan="3"><input type="password" name="password" id="password" value="<?php echo $password; ?>" readonly /></td>
			</tr>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="fullName" id="fullName" value="<?php echo $fullName; ?>" />
					<span class="error"><?php echo $nameEmp; ?></span></td>
				<td>Identity Card No:</td>
				<td><input type="text" name="ic" id="ic" value="<?php echo $ic; ?>" />
					<span class="error"><?php echo $icEmp; ?></span></td>
			</tr>
			<tr>
				<td>Position:</td>
				<td><input type="text" name="position" id="position" value="<?php echo $position; ?>" /></td>
				<td>Gender:</td>
				<td><select name="gender" id="gender" style="width:92%;">
						<option value="0">--SELECT--</option>
						<option <?php if($gender == 1) echo 'selected'; ?> value="1">Male</option>
						<option <?php if($gender == 2) echo 'selected'; ?> value="2">Female</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nationality:</td>
				<td><input type="text" name="nationality" id="nationality" value="<?php echo $nationality; ?>" readonly /></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<th colspan = "4">Company Address Information</td>
			<tr>
				<td>Company Name:</td>
				<td><input type="text" name="compName" id="compName" value="<?php echo $compName; ?>" /></td>
				<td colspan="2" rowspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td>Address:</td>
				<td><textarea rows="3" cols="30" wrap="hard" name="address" id="address"><?php echo $address; ?></textarea></td>
			</tr>
			<tr>
				<td>State:</td>
				<td><select name="state" id="state" style="width:92%;">
					<option value="0">--SELECT--</option>
						<?php 
							$state_query = "SELECT * FROM state";
							$result = mysqli_query($con, $state_query);
							while($row = mysqli_fetch_array($result))
							{
								if($state == $row['id']) { $checked = 'selected'; } else { $checked = ''; }
								echo '<option value="'.$row['id'].'"'.$checked.'>'.$row['appellation'].'</option>';
							}
						?>
					</select>
				</td>
				<td>Postcode:</td>
				<td><input type="text" name="postcode" id="postcode" value="<?php echo $postcode; ?>" /></td>
			</tr>
			<th colspan="4">Contact Information</th>
			<tr>
				<td>Office(Tel):</td>
				<td><input type="text" name="officeNo" id="officeNo" value="<?php echo $officeNo; ?>" /></td>
				<td>Email:</td>
				<td><input type="text" name="email" id="email" value="<?php echo $email; ?>" /></td>
			</tr>
			<tr>
				<td>Mobile No:</td>
				<td><input type="text" name="mobileNo" id="mobileNo" value="<?php echo $mobileNo; ?>" /></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="4"><center><input type="submit" value="UPDATE" />
								<input type="reset" value="RESET"></center></td>
			</tr>
		</table>
	</form>
	</div>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>