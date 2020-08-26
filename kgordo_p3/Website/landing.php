<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link rel="stylesheet" type="text/css" href="portal.css">
	<link rel='stylesheet' type='text/css' href='portalStyle.php' />
<style>

</style>
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
	
				<div id="Title">
					<h1 style="color:white; font-size:100px" >The Teaching</h1>
					<h1 style="color:white; font-size:100px; margin-top:-50px" >Portal</h1>
					<h2 style="color:white; font-size:28px; margin-top:-50px">Building content for the busy educators</h2>
				</div>
		
				<div id="Register">
						<div id="InputForm">
						<h1 style="text-align: center">Create new account</h1>
						<form name="CreateUser"
							  action="authNew_user.php"
							  method="post">

							<p id="FieldSpec"><input style="height:30px"  type="text" id="personName" placeholder="Enter First Name" name="firstName" size="18%"/> </p>
							<p id="FieldSpec" style="float:right; margin-right:-12%"> <input style="height:30px" type="text" id="personName" placeholder="Enter Last Name"  name="lastName" size="18%" /> </p><br><br>
							<p id="FieldSpec"> <input style="height:30px" type="text" id="personName" placeholder="Enter Username"  name="userName" size="50%"/> </p>
							<p id="FieldSpec"><input style="height:30px"  float="right" type="text" id="userEmail" placeholder="Enter Email"  name="email" size="50%"/> </p>
							<p id="FieldSpec"> <input style="height:30px"  float="right" type="text" id="userEmail" placeholder="Verify Email"  name="emailConfirm" size="50%"/> </p>
							<p id="FieldSpec"><input style="height:30px"  type="password" id="pwd" placeholder="Enter Password"  name="pwd" minlength="8" size="50%"/> </p>
							<p id="FieldSpec"> <input style="height:30px"  type="password" id="pwd" placeholder="Verify Password"  name="pwdConfirm" minlength="8" size="50%"/> </p>

							<br>
							<input class="buttonForm" style="margin-top:-0%; padding=24px;font-size:16px;margin-bottom:5%" type="submit" name="Submit" value="Submit" />

						</form>


						</div>
				</div>
		</div>
		
		
	</div>
	
</body>
</html>