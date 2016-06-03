<?php 
require_once('inc/connect.php');
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$user = $_SESSION['usertype'];

$message = $nameEmp = $icEmp = $matricEmp = $userEmp = $passEmp = $error = "";
$user = "administrator";

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$id_supervisor = $_POST['compName'];
	$id_lecturer = $_POST['l_Name'];
	
	if(empty($_POST['username'])) {
		$userEmp = "Must filled in Username.";
		$error = 1;
	}
	else {
		$username = $_POST['username']; 
	}
	if(empty($_POST['password'])) {
		$passEmp = "Must filled in Username.";
		$error = 1;
	}
	else {
		$password = md5($_POST['password']); 
	}
	if(empty($_POST['fullName'])) {
		$nameEmp = "Must filled in Full Name.";
		$error = 1;
	}
	else {
		$fullName = $_POST['fullName'];
	}
	if(empty($_POST['ic'])) {
		$icEmp = "Must filled in IC.";
		$error = 1;
	}
	else {
		$ic = $_POST['ic'];
	}
	if(empty($_POST['matricNo'])) {
		$matricEmp = "Must filled in Matric No.";
		$error = 1;
	}
	else {
		$matricNo = $_POST['matricNo'];
	}
	
	$dob = $_POST['dob'];
	$gender = $_POST['gender'];
	$major = $_POST['major'];
	$level = $_POST['level'];
	$university = $_POST['university'];
	$nationality = $_POST['nationality'];
	$student_add = $_POST['student_address'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	//$confirm = $_POST['confirm'];
	$homeT = $_POST['homeT'];
	$email = $_POST['email'];
	$mobileT = $_POST['mobileT'];
	$date_start = $_POST['date_start'];
	$date_end = $_POST['date_end'];
	
	if(empty($error)) {
		$query = "INSERT INTO students(id_supervisor, id_lecturer, username, password, fullName, ic_no, matric_no, dob, gender, major, level, university, nationality, stu_address, state, postcode, homeTel, email, mobileNo, date_start, date_end, DT_CREATE, IDENT)
				  VALUES('$id_supervisor', '$id_lecturer', '$username', '$password', '$fullName', '$ic', '$matricNo', '$dob', '$gender', '$major', '$level', '$university', '$nationality', '$student_add', '$state', '$postcode',
				  '$homeT', '$email', '$mobileT', '$date_start', '$date_end', NOW(), '$user')";			 

		if(mysqli_query($con, $query)) {
			$message = "<font color=\"green\">* Data Successfully Inserted Into Database.</font>";
		}
		else {
			$message = "<font color=\"red\">* Insert Failed!.</font>";
		}
	}
	else {
		$message = "<font color=\"red\">* Insert Failed!.</font>";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
<title>e-Internship</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-1.11.3.js"></script>
<script src="js/jquery-ui.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#dob, #date_start, #date_end").datepicker({
		beforeShow: function() {
			$(".ui-datepicker").css('font-size', 12)
		},
		dateFormat: 'yy-mm-d'
	});
	
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
	
	$("#compName").change(function(){
		var id=$(this).val();
		var dataString = 'id=' + id;
		
		$.ajax({
			type: "POST",
			url: "ajax_supervisor.php",
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(result) {
				$("#sname").val(result.sName);
				$("#scontact").val(result.officeNo);
				$("#compAddress").val(result.sAddress);
			}
		});
	});
	
	$("#l_Name").change(function(){
		var id=$(this).val();
		var dataString = 'id=' + id;
		
		$.ajax({
			type: "POST",
			url: "ajax_lecturer.php",
			data: dataString,
			dataType: 'json',
			cache: false,
			success: function(data) {
				$("#l_ic").val(data.ic);
				$("#l_address").val(data.lAddress);
				$("#l_contact").val(data.lContact);
				$("#l_email").val(data.email);
			}
		});
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
			<form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
				<table>
					<th colspan = "4"><div><?php echo $message; ?></div>Internship Students Registration Form</th>
					<tr>
						<td>Full Name: *</td>
						<td><input type="text" name="fullName" id="fullName" />
						<span class="error"><?php echo $nameEmp; ?></span></td>
						<td>Identity Card No: *</td>
						<td><input type="text" name="ic" id="ic" />
						<span class="error"><?php echo $icEmp; ?></span></td>
					</tr>
					<tr>
						<td>Matric No: *</td>
						<td><input type="text" name="matricNo" id="matricNo" />
						<span class="error"><?php echo $matricEmp; ?></span></td>
						<td>Date of Birth:</td>
						<td><input type="text" name="dob" id="dob" /></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td><select style="width:92%;" name="gender">
								<option value="0">--SELECT--</option>
								<option value="1">Male</option>
								<option value="2">Female</option>
							</select>
						</td>
						<td>Level:</td>
						<td><select name="level" style="width:92%;">
								<option value="0">--SELECT--</option>
								<option value="1">Certificate</option>
								<option value="2">Diploma</option>
								<option value="3">Degree</option>
								<option value="4">Master</option>
								<option value="5">Phd</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Major:</td>
						<td><select name="major" style="width:92%;">
								<option value="0">--SELECT--</option>
								<?php
									$major_query = "SELECT * FROM major";
									$result = mysqli_query($con, $major_query);
									while($row = mysqli_fetch_array($result))
									{
										echo '<option value="'.$row['id'].'">'.$row['appellation'].'</option>';
									}
								?>
							</select>
						</td>
						<td>College/University:</td>
						<td><select name="university" style="width:92%;">
								<option value="0">--SELECT--</option>
								<?php 
									$uni_query = "SELECT * FROM institute";
									$result = mysqli_query($con, $uni_query);
									while($row = mysqli_fetch_array($result))
									{
										echo '<option value="'.$row['id'].'">'.$row['appellation'].'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Nationality:</td>
						<td><input type="text" name="nationality" id="nationality" value="Malaysia" readonly /></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<th colspan = "4">Address Information</td>
					<tr>
						<td>Address:</td>
						<td><textarea rows="3" cols="30" wrap="hard" name="student_address" style="width:90%;"></textarea></td>
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
										echo '<option value="'.$row['id'].'">'.$row['appellation'].'</option>';
									}
								?>
							</select></td>
						<td>Postcode:</td>
						<td><input type="text" name="postcode" id="postcode" /></td>
					</tr>
					<th colspan="4">Login Information</th>
					<tr>
						<td><font color="red">Username *</font></td>
						<td colspan="3"><input type="text" name="username" id="username" />
						<span class="error"><?php echo $userEmp; ?></span></td>
					</tr>
					<tr>
						<td><font color="red">Password *</font></td>
						<td colspan="3"><input type="password" name="password" id="password" />
						<span class="error"><?php echo $passEmp; ?></span</td>
					</tr>
					<tr>
						<td><font color="red">Confirm Password *</font></td>
						<td colspan="3"><input type="password" name="confirm" id="confirm" />
						<span class="error"><?php echo $passEmp; ?></span<div id="checkPass"></div></td>
					</tr>
					<th colspan="4">Contact Information</th>
					<tr>
						<td>Home(Tel):</td>
						<td><input type="text" name="homeT" id="homeT" /></td>
						<td>Email:</td>
						<td><input type="text" name="email" id="email" /></td>
					</tr>
					<tr>
						<td>Mobile No:</td>
						<td><input type="text" name="mobileT" id="mobileT" /></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<th colspan="4">Lecturer In-Charge Information</th>
					<tr>
						<td>Name:</td>
						<td><select name="l_Name" id="l_Name" style="width:92%;">
								<option value="0">--SELECT--</option>
								<?php 
									$lquery = mysqli_query($con, "SELECT l.id, l.fullName, l.university, i.appellation 
									                              FROM lecturers AS l INNER JOIN institute AS i
																  ON l.university = i.id
																  ORDER BY fullName ASC");
									while($row = mysqli_fetch_array($lquery)) {
										$id = $row['id'];
										$lName = $row['fullName'];
										$uni = $row['appellation'];
										
										echo '<option value="'.$id.'">'.$lName.' - ('.$uni.')</option>';
									}
								?>
							</select>
						</td>
						<td>Identity Card No:</td>
						<td><input type="text" name="l_ic" id="l_ic" value="" readonly /></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><textarea rows="3" cols="30" wrap="hard" name="l_address" id="l_address" style="width:90%;" readonly></textarea></td>
						<td>Contact No:</td>
						<td><input type="text" name="l_contact" id="l_contact" value="" readonly /></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="l_email" id="l_email" value="" readonly /></td>
					</tr>
					<th colspan="4">Internship Information</th>
					<tr>
						<td>Date Start:</td>
						<td><input type="text" id="date_start" name="date_start" /></td>
						<td>Date End:</td>
						<td><input type="text" id="date_end" name="date_end" /></td>
					</tr>
					<tr>
						<td>Company Name:</td>
						<td>
							<select id = "compName" name="compName" style="width:92%;">
								<option value="0">--SELECT--</option>
								<?php
									$sql = mysqli_query($con,"SELECT id, compName FROM supervisors ORDER BY compName ASC");
									while($row = mysqli_fetch_array($sql)) {
										$id = $row['id'];
										$data = $row['compName'];
										echo '<option value="'.$id.'">'.$data.'</option>';
									}
								?>
							</select>
						</td>
						<td colspan="2" rowspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td>Company Address:</td>
						<td><textarea rows="3" cols="30" wrap="hard" name="compAddress" id="compAddress" style="width:90%;" readonly></textarea></td>
					</tr>
					<tr>
						<td>Supervisor Name:</td>
						<td><input type="text" name="sname" id="sname" value="" readonly /></td>
						<td>Supervisor Contact No:</td>
						<td><input type="text" name="scontact" id="scontact" value="" readonly /></td>
					</tr>
					<tr>
						<td colspan="4"><center><input type="submit" value="SAVE" />
									<input type="reset" value="RESET"></center>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>