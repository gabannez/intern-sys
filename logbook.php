<?php 
session_start();

if(!isset($_SESSION['username']) && !isset($_SESSION['login_success'])) {
	header('location:index.php');
}

$usertype = $_SESSION['usertype'];
$fullname = $_SESSION['fullname'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8">
<title>e-Internship</title>
<!--<link rel="stylesheet" href="css/style.css">-->
<link rel="stylesheet" type="text/css" href="css/easyui.css">
<link rel="stylesheet" type="text/css" href="css/icon.css">
<link rel="stylesheet" type="text/css" href="css/demo.css">
<style>
body {
	font-family:Arial, Helvetica, sans-serif;
	background:#F8F8F8;
}

#SiteBody {
	width:960px;
	margin: 0 auto;
	min-width:300px;
	max-width:2000px;
}
.searchLog {
	margin-top:80px;
}
.container {
	position:relative;
	width:100%;
}
.error {
	font-size:12px;
	color:red;
}
.title-left {
	font-size:12px;
	margin-left:50px;
	margin-top:-30px;
}

.title-med {
	font-size:12px;
	margin-left:50px;
	margin-top:20px;
}

.title-right {
	font-size:12px;
	margin-left:150px;
	margin-top:-35px;
}

img.profile {
	position:absolute;
}

img.logout {
	margin-left:100px;
	margin-top:-35px;
}
a:link {
	text-decoration:none;
}

a:visited {
	text-decoration:none;
}

a:active {
	text-decoration:none;
}

a:hover {
	text-decoration:none;
	color:blue;
}
#header-form {
	width:960px;
	height:50px;
	background:lightblue;
	background-image:url("images/banner2.png");
}
#nav-left {
	height:50px;
	float:left;
	margin-top:10px;
	margin-left:30px;
}

#nav-right {
	height:50px;
	margin-top:10px;
	float:right;
	margin-right:30px;
}
</style>
<script type="text/javascript" src="js/jquery-1.6.min.js"></script>
<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
<script type="text/javascript" src="js/jquery.edatagrid.js"></script>
<script type="text/javascript">
	$(function(){
		$('#dg').edatagrid({
			url: 'logbook_select.php',
			saveUrl: 'logbook_create.php',
			updateUrl: 'logbook_update.php',
			destroyUrl: 'logbook_delete.php'
		});
		
		$.fn.datebox.defaults.formatter = function(date) {
			var y = date.getFullYear();
			var m = date.getMonth()+1;
			var d = date.getDate();
			return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
		}
		
		$.fn.datebox.defaults.parser = function(s) {
			var t = Date.parse(s);
			if(!isNaN(t)) {
				return new Date(t);
			}
			else {
				return new Date();
			}
		}
	});
</script>
</head>
<body>
	<div id="SiteBody">
		<div id="header-form"></div>
		<div id="nav-left">
			<a href="menu.php" class="link"><img src="images/home.png" alt="home">
				<div class="title-left">
					Home
				</div>
			</a>
		</div>
		<div id="nav-right">
			<a href="change_pass.php" class="link"><img src="images/profile.png" alt="profile" class="profile">
				<div class="title-med">My Profile</div>
			</a>
			<a href="logout.php" class="link"><img src="images/logout.png" alt="logout" class="logout">
				<div class="title-right">Logout</div>
			</a>
		</div>
		<div id="container">
			<div class="searchLog">
				<?php if($usertype < 2) { 
					echo 'Full Name: '.$fullname.'';
				 } ?>
				<table id="dg" title="My Logbook" style="width:900px;height:400px" 
					toolbar="#toolbar" pagination="true" idField="id"
					rownumbers="true" fitColumns="true" singleSelect="true">
					<thead>
						<tr>
							<th field="date" width="50" editor="{type:'datebox',options:{required:true}}">Date</th>
							<th field="day" width="50" editor="{type:'validatebox',options:{required:true}}">Day</th>
							<th field="task_activities" width="50" editor="{type:'textarea',options:{required:true}}">Task Activities</th>
							<th field="remarks" width="50" editor="textarea">Remarks</th>
						</tr>
					</thead>
				</table>
				<div id="toolbar">
				<?php if($usertype < 2) { ?>
					<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
					<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Delete</a>
					<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
					<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
				<?php } ?>
				</div> 
			</div>
		</div>
	</div>
</body>
</html>
