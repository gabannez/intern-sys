<?php 
require_once('inc/connect.php');

$id_edit = $_GET['edit'];
$user = "administrator";

$sql = "SELECT * FROM lecturers WHERE id = '$id_edit'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$id = $row['id'];
$username = $row['username'];
$password = $row['password'];
$fullName = $row['fullName'];
$ic = $row['ic'];
$gender = $row['gender'];
$nationality = $row['nationality'];
$university = $row['university'];
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
	$gender = $_POST['gender'];
	$nationality = $_POST['nationality'];
	$university = $_POST['university'];
	$address =  $_POST['address'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$officeNo = $_POST['officeNo'];
	$email = $_POST['email'];
	$mobileNo = $_POST['mobileNo'];
	
	if(empty($error)) {
		$sql = "UPDATE lecturers SET username = '$username', password = '$password', fullName = '$fullName', ic = '$ic', gender = '$gender',
		        nationality = '$nationality', university = '$university', address = '$address', state = '$state', postcode = '$postcode', officeNo = '$officeNo',
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
	<div id="header-form">E-Internship</div>
	<div id="nav-left">
			<a href="#" class="link"><img src="/eintern/images/home.png" alt="home">
				<div class="title-left">
					Home
				</div>
			</a>
	</div>
	<div id="nav-right">
		<a href="#" class="link"><img src="/eintern/images/profile.png" alt="profile" class="profile">
			<div class="title-med">My Profile</div>
		</a>
		<a href="#" class="link"><img src="/eintern/images/logout.png" alt="logout" class="logout">
			<div class="title-right">Logout</div>
		</a>
	</div>
	<div id="container">
	<form method="post" action="<?php echo "lecturer_update.php?edit=$id_edit"; ?>">
		<table>
			<th colspan = "4"><div><?php echo $message; ?></div>Lecturer Registration Form</th>
			<tr>
				<td><font color="red">Username: * </font></td>
				<td colspan="3"><input type="text" name="username" id="username" value="<?php echo $username; ?>" readonly /></td>
			</tr>
			<tr>
				<td><font color="red">Password: * </font></td>
				<td colspan="3"><input type="text" name="password" id="password" value="<?php echo $password; ?>" readonly /></td>
			</tr>
			<tr>
				<td>Full Name: *</td>
				<td><input type="text" name="fullName" id="fullName" value="<?php echo $fullName; ?>" />
				<span class="error"><?php echo $nameEmp; ?></span></td>
				<td>Identity Card No: *</td>
				<td><input type="text" name="ic" id="ic" value="<?php echo $ic; ?>" />
				<span class="error"><?php echo $icEmp; ?></span></td>
			</tr>
			<tr>
				<td>Gender:</td>
				<td><select style="width:92%;" name="gender" id="gender">
						<option value="0">--SELECT--</option>
						<option <?php if($gender == 1) echo 'selected'; ?> value="1">Male</option>
						<option <?php if($gender == 2) echo 'selected'; ?> value="2">Female</option>
					</select></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td>Nationality:</td>
				<td><input type="text" name="nationality" id="nationality" value="Malaysia" readonly /></td>
				<td>College/University:</td>
				<td><select name="university" style="width:92%;">
					<option value="0">--SELECT--</option>
						<?php 
							$uni_query = "SELECT * FROM institute";
							$result = mysqli_query($con, $uni_query);

							while($row = mysqli_fetch_array($result))
							{
								if($university == $row['id']) { $checked = 'selected'; } else { $checked = ''; }
								echo '<option value="'.$row['id'].'"'.$checked.'>'.$row['appellation'].'</option>';
							}
						?>
					</select>
				</td>
			</tr>
			<th colspan = "4">Address Information</td>
			<tr>
				<td>Address:</td>
				<td><textarea rows="3" cols="30" wrap="hard" name="address"><?php echo $address; ?></textarea></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td>State:</td>
				<td><select name="state" style="width:92%;">
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
								<input type="reset" value="RESET" /></center></td>
			</tr>
		</table>
	</form>
	</div>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>