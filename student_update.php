<?php 
require_once('inc/connect.php');
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$id_edit = $_GET['edit'];

$query = "SELECT * FROM students
		  WHERE id = '$id_edit'";
		  
$result = mysqli_query($con, $query);
$row = mysqli_fetch_array($result);
	
	$id_supervisor = $row['id_supervisor'];
	$id_lecturer = $row['id_lecturer'];
	$username = $row['username'];
	$password = $row['password'];
	$fullName = $row['fullName'];
	$ic = $row['ic_no'];
	$matricNo = $row['matric_no'];
	$dob = $row['dob'];
	$gender = $row['gender'];
	$major = $row['major'];
	$level = $row['level'];
	$university = $row['university'];
	$nationality = $row['nationality'];
	$student_add = $row['stu_address'];
	$state = $row['state'];
	$postcode = $row['postcode'];
	$homeT = $row['homeTel'];
	$email = $row['email'];
	$mobileT = $row['mobileNo'];
	$date_start = $row['date_start'];
	$date_end = $row['date_end'];

$query2 = "SELECT * FROM supervisors
           WHERE id = '$id_supervisor'";
		   
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_array($result2);

$supervisor_id = $row2['id'];
$s_fullName = $row2['fullName'];
$compName = $row2['compName'];
$compAddress = $row2['address'];
$s_contact = $row2['officeNo'];

$query3 = "SELECT * FROM lecturers
		   WHERE id = '$id_lecturer'";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_array($result3);

$lecturer_id = $row3['id'];
$l_fullName = $row3['fullName'];
$l_ic = $row3['ic'];
$l_address= $row3['address'];
$l_contact = $row3['officeNo'];
$l_email = $row3['email'];

$message = $nameEmp = $icEmp = $matricEmp = $error = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$id_edit = $_GET['edit'];

	$user = "administrator";
	$id_supervisor = $_POST['compName'];
	$id_lecturer = $_POST['l_Name'];
	$username = $_POST['username']; 
			
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
	$password = $_POST['password'];
	$homeT = $_POST['homeT'];
	$email = $_POST['email'];
	$mobileT = $_POST['mobileT'];
	$date_start = $_POST['date_start'];
	$date_end = $_POST['date_end'];
	
	if(empty($error)) 
	{
		$query = "UPDATE students SET id_supervisor = '$id_supervisor', id_lecturer = '$id_lecturer', username = '$username', password = '$password', fullName = '$fullName', 
				  ic_no = '$ic', matric_no = '$matricNo', dob = '$dob', gender = '$gender', major = '$major', level = '$level', university = '$university', nationality = '$nationality', 
				  stu_address = '$student_add', state = '$state', postcode = '$postcode', homeTel = '$homeT', email = '$email', mobileNo = '$mobileT', date_start = '$date_start', 
				  date_end = '$date_end', DT_CREATE = NOW(), IDENT = '$user' WHERE id = '$id_edit'";
		$result = mysqli_query($con, $query);

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
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-1.11.3.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
$(document).ready(function() {
	$("#dob, #date_start, #date_end").datepicker({
		beforeShow: function() {
			$(".ui-datepicker").css('font-size', 12)
		},
		dateFormat: 'yy-mm-d'
	});
	
	$("#compName").change(function(){
		var id=$(this).val();
		var dataString = 'id=' + id;
		
		$.ajax({
			type: "POST",
			url: "ajax_supervisor.php",
			data: dataString,
			dataType: 'json',
			success: function(result) {
				$("#s_name").val(result.sName);
				$("#s_contact").val(result.officeNo);
				$("#comp_Address").val(result.sAddress);
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
			<form method = "post" action = "<?php echo "student_update.php?edit=$id_edit"; ?>">
				<table>
					<th colspan = "4"><div><?php echo $message; ?></div>Internship Students Registration Form</th>
					<tr>
						<td>Full Name:</td>
						<td><input type="text" name="fullName" id="fullName" value="<?php echo $fullName; ?>"/></td>
						<td>Identity Card No:</td>
						<td><input type="text" name="ic" id="ic" value="<?php echo $ic; ?>" />
						    <span class="error"><?php echo $icEmp; ?></span></td>
					</tr>
					<tr>
						<td>Matric No:</td>
						<td><input type="text" name="matricNo" id="matricNo" value="<?php echo $matricNo; ?>" />
							<span class="error"><?php echo $matricEmp; ?></span></td></td>
						<td>Date of Birth:</td>
						<td><input type="text" name="dob" id="dob" value="<?php echo $dob; ?>" /></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td><select style="width:92%;" name="gender">
								<option value="0">--SELECT--</option>
								<option <?php if($gender == 1) echo 'selected'; ?> value="1">Male</option>
								<option <?php if($gender == 2) echo 'selected'; ?> value="2">Female</option>
							</select>
						</td>
						<td>Level:</td>
						<td><select name="level" style="width:92%;">
								<option value="0">--SELECT--</option>
								<option <?php if($level == 1) echo 'selected'; ?> value="1">Certificate</option>
								<option <?php if($level == 2) echo 'selected'; ?> value="2">Diploma</option>
								<option <?php if($level == 3) echo 'selected'; ?> value="3">Degree</option>
								<option <?php if($level == 4) echo 'selected'; ?> value="4">Master</option>
								<option <?php if($level == 5) echo 'selected'; ?> value="5">Phd</option>
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
										if($major == $row['id']) { $checked = 'selected'; } else { $checked = ''; }
										echo '<option value="'.$row['id'].'"'.$checked.'>'.$row['appellation'].'</option>';
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
										if($university == $row['id']) { $checked = 'selected'; } else { $checked = ''; }
										echo '<option value="'.$row['id'].'"'.$checked.'>'.$row['appellation'].'</option>';
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Nationality:</td>
						<td><input type="text" name="nationality" id="nationality" value="<?php echo $nationality; ?>" readonly /></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<th colspan = "4">Address Information</td>
					<tr>
						<td>Address:</td>
						<td><textarea rows="3" cols="30" wrap="hard" name="student_address"><?php echo $student_add; ?></textarea></td>
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
							</select></td>
						<td>Postcode:</td>
						<td><input type="text" name="postcode" id="postcode" value="<?php echo $postcode; ?>" /></td>
					</tr>
					<th colspan="4">Login Information</th>
					<tr>
						<td><font color="red">Username *</font></td>
						<td colspan="3"><input type="text" name="username" id="username" value="<?php echo $username; ?>" readonly /></td>
					</tr>
					<tr>
						<td><font color="red">Password *</font></td>
						<td colspan="3"><input type="password" name="password" id="password" value="<?php echo $password; ?>" readonly /></td>
					</tr>
					<th colspan="4">Contact Information</th>
					<tr>
						<td>Home(Tel):</td>
						<td><input type="text" name="homeT" id="homeT" value="<?php echo $homeT; ?>" /></td>
						<td>Email:</td>
						<td><input type="text" name="email" id="email" value="<?php echo $email; ?>" /></td>
					</tr>
					<tr>
						<td>Mobile No:</td>
						<td><input type="text" name="mobileT" id="mobileT" value="<?php echo $mobileT; ?>" /></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<th colspan="4">Lecturer In-Charge Information</th>
					<tr>
						<td>Name:</td>
						<td><select id="l_Name" name="l_Name" style="width:92%;">
								<option value="0">--SELECT--</option>
								<?php 
									$sql = mysqli_query($con, "SELECT l.id, l.fullName, l.university, i.appellation 
									                           FROM lecturers AS l 
															   INNER JOIN institute AS i
															   ON l.university = i.id");
									while($row = mysqli_fetch_array($sql)) {
										
										if($id_lecturer == $row['id']) { $checked = 'selected'; } else { $checked = ''; }
										echo '<option value="'.$row['id'].'"'.$checked.'>'.$row['fullName'].' - ('.$row['appellation'].')</option>';
									}
								?>
						    </select></td>
						<td>Identity Card No:</td>
						<td><input type="text" name="l_ic" id="l_ic" value="<?php echo $l_ic; ?>" /></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><textarea rows="3" cols="30" wrap="hard" name="l_address" id="l_address"><?php echo $l_address; ?></textarea></td>
						<td>Contact No:</td>
						<td><input type="text" name="l_contact" id="l_contact" value="<?php echo $l_contact; ?>" /></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><input type="text" name="l_email" id="l_email" value="<?php echo $l_email; ?>" /></td>
					</tr>
					<th colspan="4">Internship Information</th>
					<tr>
						<td>Date Start:</td>
						<td><input type="text" id="date_start" name="date_start" value="<?php echo $date_start; ?>" /></td>
						<td>Date End:</td>
						<td><input type="text" id="date_end" name="date_end" value="<?php echo $date_end; ?>" /></td>
					</tr>
					<tr>
						<td>Company Name:</td>
						<td><select id="compName" name="compName" style="width:92%;">
								<option value="0">--SELECT--</option>
								<?php 
									$sql = mysqli_query($con, "SELECT id, compName FROM supervisors");
									while($row = mysqli_fetch_array($sql)) {
										
										if($id_supervisor == $row['id']) { $checked = 'selected'; } else { $checked = ''; }
										echo '<option value="'.$row['id'].'"'.$checked.'>'.$row['compName'].'</option>';
									}
								?>
						    </select>
						</td>
						<td colspan="2" rowspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td>Company Address:</td>
						<td><textarea rows="3" cols="30" wrap="hard" name="comp_Address" id="comp_Address"><?php echo $compAddress; ?></textarea></td>
					</tr>
					<tr>
						<td>Supervisor Name:</td>
						<td><input type="text" name="s_name" id="s_name" value="<?php echo $s_fullName; ?>" /></td>
						<td>Supervisor Contact No:</td>
						<td><input type="text" name="s_contact" id="s_contact" value="<?php echo $s_contact; ?>" /></td>
					</tr>
					<tr>
						<td colspan="4"><center><input type="submit" value="UPDATE" />
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