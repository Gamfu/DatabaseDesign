<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
	<link rel="stylesheet" type="text/css" href="portal.css">
<link rel='stylesheet' type='text/css' href='portalStyle.php' />
</head>

<body>
	
	<?php
	session_start();
	echo "<div id='topMenuer'>
		<form action='userSession.php' method='post' id='profileSelect'> </form>
		
		<div class='dropdown'>
	";
	if($_SESSION['isLoggedIn'] == true){
		if($_SESSION['AcctType'] == 1){ 
					echo "<button class='dropbtn' style='float:right; margin-right:5%;padding-top:2%' >" . $_SESSION['User'] . "</button>
					<div class='dropdown-content'>
						  <button><a href='AdminConsole.php'>Admin Console</a></button>
						  <button><a href='adminManage_Access.php'>Manage Users</a></button>
						  <button><a href='courseManage_Access.php'>Manage Courses</a></button>
						  <button><a href='reset.php'>Account Settings</a></button>
						  <button type='submit' form='profileSelect' name='Logout' value='Submit'>Sign Out</button>
						  </div>
					</div> 
					";
					}
		
				else{
					echo "<button class='dropbtn' style='float:right; margin-right:5%;padding-top:2%' >" . $_SESSION['User'] . "</button>
							<div class='dropdown-content'>
						  <button><a href='TeacherConsole.php'>Teacher Console</a></button>
						  <button><a href='reset.php'>Account Settings</a></button>
						  <button type='submit' form='profileSelect' name='Logout' value='Submit'>Sign Out</button>
						  </div>
					</div> 
					";
					}
			}
	else{
		echo "<a style='float:right; margin-right:5%;padding-top:2%' href='login.php'>Login</a>";
	} 
	echo "</div>";
	?>
	
	<div id="Container">
	<div id="splash">
		<img class="splashImg" src="images/teacher_splash.png">
		<img class="splashImg" style="z-index:-1" src="images/Rectangle 1.png">
			<div id="Login">
					<div id="InputForm">
					<h1 style="text-align: center">Login</h1>
					<form name="LoginUser"
						  action="authLog.php"
						  method="post">

						<p id="FieldSpec"><input class="fieldSize" type="text" id="personName" name="userName" placeholder="Enter Username" size="50%"/> </p>
						<p id="FieldSpec"><input class="fieldSize"  type="password" id="pwd" name="pwd" placeholder="Enter Password"  minlength="8" size="50%"/> </p>

						<br>	<br>	<br><br><br><br><br><br>
						<a href="">Forgot Username</a><br><br>
						<a href="resetUnknownUser.php">Reset Password</a>
						<p ><input class="buttonForm" style="margin-top:-18%" type="submit" name="SubmitLog" value="Submit" /></p>
					</form>


					</div>
			</div>
	</div>	
		
	</div>
	
	
</body>
</html>