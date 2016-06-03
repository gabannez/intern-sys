<?php 
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$user = $_SESSION['usertype'];
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
		<div id="nav-left">
			<a href="menu.php" class="link"><img src="images/home.png" alt="home">
				<div class="title-left">
					Home
				</div>
			</a>
		</div>
		<div id="nav-right">
			<a href="change_pass.php" class="link"><img src="images/profile.png" alt="profile" class="profile">
				<div class="title-med">MyProfile</div>
			</a>
			<a href="logout.php" class="link"><img src="images/logout.png" alt="logout" class="logout">
				<div class="title-right">Logout</div>
			</a>
		</div>
		<div id="container">
			<div class="menu" align="center">
				<?php
					if($user == 1) {
						echo '<table>
						      <th>Student Menu</th>
							  <tr>
								<td align="center"><a href="student_update.php?edit='.$_SESSION['id'].'">View Info</a></td>
							  </tr>
							  <tr>
								<td align="center"><a href="logbook.php">Logbook Module</a></td>
							  </tr>
						      </table>';
					}
					elseif($user == 2) {
						echo '<table>
						      <th>Supervisor Menu</th>
							  <tr>
								<td align="center"><a href="supervisor_update.php?edit='.$_SESSION['id'].'">View Info</td>
							  </tr>
							  <tr>
								<td align="center"><a href="logbook.php">View Logbook</a></td>
							  </tr>
						      </table>';
					}
					elseif($user == 3) {
						echo '<table>
						      <th>Lecturer Menu</th>
							  <tr>
								<td align="center"><a href="student_list.php">View Student List</a></td>
							  </tr>
							  <tr>
								<td align="center"><a href="logbook.php">View Logbook</a></td>
							  </tr>
							  <tr>
								<td align="center"><a href="lecturer_update.php?edit='.$_SESSION['id'].'">View Info</td>
							  </tr>
						      </table>';
					}
					elseif(isset($_SESSION['role'])) {
						$_SESSION['usertype'] = $_SESSION['role'];
						echo '<table>
						      <th colspan="2">Admin Menu</th>
							  <tr>
								<td align="center" rowspan="2">Students Module</td>
								<td align="center"><a href="student_create.php">Create New</a></td>
							  </tr>
							  <tr>
								<td align="center"><a href="student_list.php">Students List</a></td>
							  </tr>
							  <tr>
								<td align="center" rowspan="2">Supervisors Module</td>
								<td align="center"><a href="supervisor_create.php">Create New</a></td>
							  </tr>
							  <tr>
								<td align="center"><a href="supervisor_list.php">Supervisors List</a></td>
							  </tr>
							  <tr>
								<td align="center" rowspan="2">Lecturer Module</td>
								<td align="center"><a href="lecturer_create.php">Create New</a></td>
							  </tr>
							  <tr>
								<td align="center"><a href="lecturer_list.php">Lecturers List</a></td>
							  </tr>
							  <tr>
								<td align="center" rowspan="2">Major Module</td>
								<td align="center"><a href="admin_major_create.php">Create New</a></td>
							  </tr>
							  <tr>
								<td align="center"><a href="admin_major_list.php">Major List</a></td>
							  </tr>
							  <tr>
								<td align="center" rowspan="2">State Module</td>
								<td align="center"><a href="admin_state_create.php">Create New</a></td>
							  </tr>
							   <tr>
								<td align="center"><a href="admin_state_list.php">State List</a></td>
							  </tr>
							  <tr>
								<td align="center" rowspan="2">Institute Module</td>
								<td align="center"><a href="admin_institute_create.php">Create New</a></td>
							  </tr>
							  <tr>
								<td align="center"><a href="admin_institute_list.php">Institute List<a></td>
							  </tr>
						      </table>';
					}
					else {
						echo '<font color="red">You are not authorized to access this system.</font>';
					}
				?>				 
			</div>
		</div>
		<div id="footer"><center><p>e-Internship @ 2015</p></center></div>
	</div>
</body>
</html>