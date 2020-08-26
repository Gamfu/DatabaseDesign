<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel='stylesheet' type='text/css' href='portalStyle.php' />
	
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
	
	echo"<div id='Container'>"
	?>
	<div id="sideMenu">
		<button onclick="document.location='AdminConsole.php'" class='NavBtn' href='AdminConsole.php' type='submit' form='adminSelect' name='AdminProfile' value='Submit'>Admin</button>
		<button onclick="document.location='TeacherConsole.php'" style='padding-left:12%; padding-right:12%;' class='NavBtn' href='TeacherConsole.php' type='submit' form='teacherSelect' name='TeacherProfile' value='Submit'>Teacher</button>
	</div>
	
	<?php

		echo"<div id='ContentContain'>";
		echo"<h2 class='pageTitle'>Manage Users</h2><br>";
	$userEmail = $_SESSION['Email'];
	$userFirstName = $_SESSION['FirstName'];
	$userLastName = $_SESSION['LastName'];
	$userRole = $_SESSION['UserRole'];
	
		$conn = mysqli_connect('localhost:3308', 'root', '');
	
			if(!$conn){
				die("Connection failed: " . mysqli_connect_error());
			}
		
			else{ 
					mysqli_select_db($conn, 'user_database');
					$doesEmailExist = "SELECT FirstName, LastName, Username, Email, isAdmin FROM AcctTable";
				
					
					$resultE = mysqli_query($conn,$doesEmailExist);
				
					if(mysqli_num_rows($resultE)){
						while ($rows = mysqli_fetch_assoc($resultE)){
						$targetUser = 	$rows['Username'];
	//The actual page content is below this comment
	echo "
		<div id='Users'>
		<form action='userSession.php' method='post' id='updateContent'> </form>
			
			<div id='Section0'>
			<button class='deleteFit' form='updateContent' name='Drop' value=" . $targetUser. "><b>X</b></button>
			</div>
			
			<div id='Section1'>
				<p class='headerFit' style='color:#2CD5A7'><b>".$rows['Email']."</b></p> 
				<p  class='headerFit' style='color:#2CD5A7'>".$rows['Username']."</p>
				<p class='rowFit'>".$rows['FirstName']."</p>
				<p class='rowFit'>".$rows['LastName']."</p>
			</div>
			
			<div id='Section2'>
						<h2>User Role</h2>" ;
						if($rows['isAdmin'] == 1){
								echo " 
										<button class='rowFit' style='color:#2CD5A7;background-color:none' form='updateContent' name='GlobalAdminProfile' value=" . $targetUser. "><b>Admin</b></button>
										<button class='rowFit' form='updateContent' name='GlobalTeacherProfile' value=" . $targetUser. ">Teacher</button>
								";
							}else{
								echo " 
										<button class='rowFit' form='updateContent' name='GlobalAdminProfile' value='$targetUser'>Admin</button>
										<button class='rowFit' style='color:#2CD5A7;background-color:none' form='updateContent' name='GlobalTeacherProfile' value='$targetUser'><b>Teacher</b></button>
								";
							}
				echo "</div>
				
				<form name='File Manager' 
										action='userSession.php'
										method='post'
										enctype='multipart/form-data'
										>
				
				<div id='Section3'>
									<h2>Course Access</h2>";
									PopulateCourse();
								echo "</div>
							<div id='Section4'>
							
							 <button class='buttonForm' style='margin-top:50%' type='submit' name='UpdateCourse' value='$targetUser'>Submit</button>
							
							</div>
					</form>
	
		</div>
	
	";
						}
					}
			}
	
	echo "</div>";
	
	
	/*
	//Query first name across database
	$conn = mysqli_connect('localhost:3308', 'root', '');
	
			if(!$conn){
				die("Connection failed: " . mysqli_connect_error());
			}
		
			else{ 
					mysqli_select_db($conn, 'user_database');
					$doesEmailExist = "SELECT FirstName, LastName, Email, isAdmin FROM AcctTable";
				
					
					$resultE = mysqli_query($conn,$doesEmailExist);
				
					if(mysqli_num_rows($resultE)){
						while ($rows = mysqli_fetch_assoc($resultE)){
							echo "Name: " . $rows['FirstName'];
						}
					}
			}
	
	*/
	
	function PopulateCourse(){
						$conn = NEW MySQLi('localhost:3308','root','','user_database');

						$resultCourse = $conn->query("SELECT course_name FROM Courses");
											?>
								<form name="File Manager" 
										action="userSession.php"
										method="post"
										enctype="multipart/form-data"
										>

							   <select id= "CourseSelection" name="Course">
									<?php 
								   echo  "<option value='Blank' >Select course</option>";
										while($rows = $resultCourse->fetch_assoc())
										{
											$course_name = $rows['course_name'];
											echo "<option value='$course_name'>$course_name</option>";
										 } 		
									echo "<option value='New' >Add new course</option>";
									?>
								</select>


				<?php
		}
	
	
	
	?>
</body>
</html>