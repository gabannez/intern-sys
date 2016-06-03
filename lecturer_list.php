<?php 
require_once('inc/connect.php');
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}


$i = 0;
$list = array();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$searchtext = trim($_POST['searchText']);
	
	$query = mysqli_query($con, "SELECT * FROM lecturers WHERE fullName LIKE '%$searchtext%' OR university LIKE '%$searchtext%'
	                             OR address LIKE '%$searchtext%' OR officeNo LIKE '%searchtext%' OR email LIKE '%searchtext%'");
	$count = mysqli_num_rows($query);
	
	if($count > 0) {
		while($row = mysqli_fetch_assoc($query)) {
			$i++;
			$fullName = $row['fullName'];
			$university = $row['university'];
			$address = $row['address'];
			$officeNo = $row['officeNo'];
			$email = $row['email'];
			
			$query2 = mysqli_query($con, "SELECT id, appellation FROM institute WHERE id = $university");
			$row2 = mysqli_fetch_array($query2);
			
			$list[] = array($i, $fullName, $row2['appellation'], $address, $officeNo, $email);
		}
	}
	else {
		$msg = "<div align=\"center\" style=\"margin-top:50px;\"><font color=\"red\">No result found.</font></div>";
	} 	
}
else {
	$query = mysqli_query($con, "SELECT * FROM lecturers");
	while($row = mysqli_fetch_assoc($query)) {
		$i++;
		$fullName = $row['fullName'];
		$university = $row['university'];
		$address = $row['address'];
		$officeNo = $row['officeNo'];
		$email = $row['email'];
		
		$query2 = mysqli_query($con, "SELECT id, appellation FROM institute WHERE id = $university");
		$row2 = mysqli_fetch_array($query2);
		
		$list[] = array($i, $fullName, $row2['appellation'], $address, $officeNo, $email);
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
			<div class="searchLog">	
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<table style="margin-top:0%;">
						<th colspan="6">Search Information</th>
						<tr>
							<td>Search:</td>
							<td><input type="text" name="searchText" /></td>
							<td><input type="submit" value="Search" /></td>
						</tr>
					</table>
				</form>
			</div>
			<?php 
				if(isset($msg)) {
					echo $msg;
				}
				else {
			?>
			<table>
				<th>No</th>
				<th>Full Name</th>
				<th>Institute</th>
				<th>Address</th>
				<th>Office No</th>
				<th>Email</th>
				<th colspan="2">Action</th>
				<tr>
				<?php 
					$n = 0;
					$max = sizeOf($list);
					$query = mysqli_query($con, "SELECT id FROM lecturers");
					
					while($n < $max) {
						foreach($list[$n] as $value) {
							echo '<td align="center">'.$value.'</td>';
						}
						$row = mysqli_fetch_array($query);
						$id = $row['id'];
						echo '<td align="center"><a href="lecturer_update.php?edit='.$id.'"><img src="images/edit.png" width="20" height="20" /> Edit</td>';
						echo '<td align="center"><a href="lecturer_delete.php?del='.$id.'"><img src="images/delete.png" width="20" height="20" /> Delete</td>';
						echo '<tr></tr>';
						$n++;
					}
				?>
				</tr>
			</table>
			<?php } ?>
		</div>
	</div>
</body>
</html>