<?php 
require_once('inc/connect.php');

session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$user = $_SESSION['usertype'];

$id_edit = $_GET['view'];

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
			<form method = "post" action = "<?php echo "student_update.php?edit=$id_edit"; ?>">
				<table>
					<th colspan = "4">Internship Students Registration Form</th>
					<tr>
						<td>Full Name:</td>
						<td><?php echo $fullName; ?></td>
						<td>Identity Card No:</td>
						<td><?php echo $ic; ?></td>
					</tr>
					<tr>
						<td>Matric No:</td>
						<td><?php echo $matricNo; ?></td>
						<td>Date of Birth:</td>
						<td><?php echo $dob; ?></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td><?php if($gender == 1) { echo 'Male'; } else { echo 'Female'; } ?> </td>
						<td>Level:</td>
						<td>
							<?php if($level == 1) { echo 'Certificates'; } 
								  elseif($level == 2) { echo 'Diploma'; }
								  elseif($level == 3) { echo 'Degree'; }
								  elseif($level == 4) { echo 'Master'; }
								  else { echo 'Phd'; }
							?>
						</td>
					</tr>
					<tr>
						<td>Major:</td>
						<td>
							<?php
								$major_query = "SELECT * FROM major";
								$result = mysqli_query($con, $major_query);
		
								while($row = mysqli_fetch_array($result))
								{
									if($major == $row['id'])
									echo $row['appellation'];
								}
							?>
						</td>
						<td>College/University:</td>
						<td>
							<?php 
								$uni_query = "SELECT * FROM institute";
								$result = mysqli_query($con, $uni_query);

								while($row = mysqli_fetch_array($result))
								{
									if($university == $row['id'])
									echo $row['appellation'];
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Nationality:</td>
						<td><?php echo $nationality; ?></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<th colspan = "4">Address Information</td>
					<tr>
						<td>Address:</td>
						<td><?php echo $student_add; ?></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td>State:</td>
						<td>						
							<?php 
									$state_query = "SELECT * FROM state";
									$result = mysqli_query($con, $state_query);
									while($row = mysqli_fetch_array($result))
									{
										if($state == $row['id'])
										echo $row['appellation'];
									}
								?>
							</td>
						<td>Postcode:</td>
						<td><?php echo $postcode; ?></td>
					</tr>
					<th colspan="4">Contact Information</th>
					<tr>
						<td>Home(Tel):</td>
						<td><?php echo $homeT; ?></td>
						<td>Email:</td>
						<td><?php echo $email; ?></td>
					</tr>
					<tr>
						<td>Mobile No:</td>
						<td><?php echo $mobileT; ?></td>
						<td colspan="2">&nbsp;</td>
					</tr>
					<th colspan="4">Lecturer In-Charge Information</th>
					<tr>
						<td>Name:</td>
						<td>
							<?php 
								$sql = mysqli_query($con, "SELECT l.id, l.fullName, l.university, i.appellation 
														   FROM lecturers AS l 
														   INNER JOIN institute AS i
														   ON l.university = i.id");
								while($row = mysqli_fetch_array($sql)) {
									
									if($id_lecturer == $row['id'])
									echo $row['fullName'].' - '.$row['appellation'];
								}
							?>
						</td>
						<td>Identity Card No:</td>
						<td><?php echo $l_ic; ?></td>
					</tr>
					<tr>
						<td>Address:</td>
						<td><?php echo $l_address; ?></td>
						<td>Contact No:</td>
						<td><?php echo $l_contact; ?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?php echo $l_email; ?></td>
					</tr>
					<th colspan="4">Internship Information</th>
					<tr>
						<td>Date Start:</td>
						<td><?php echo $date_start; ?></td>
						<td>Date End:</td>
						<td><?php echo $date_end; ?></td>
					</tr>
					<tr>
						<td>Company Name:</td>
						<td>
							<?php 
								$sql = mysqli_query($con, "SELECT id, compName FROM supervisors");
								while($row = mysqli_fetch_array($sql)) {
									
									if($id_supervisor == $row['id'])
									echo $row['compName'];
								}
							?>
						</td>
						<td colspan="2" rowspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td>Company Address:</td>
						<td><?php echo $compAddress; ?></td>
					</tr>
					<tr>
						<td>Supervisor Name:</td>
						<td><?php echo $s_fullName; ?></td>
						<td>Supervisor Contact No:</td>
						<td><?php echo $s_contact; ?></td>
					</tr>
					<tr>
						<td colspan="4" align="center">
							<a href="student_list.php">Back to Student List</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
<?php mysqli_close($con); ?>