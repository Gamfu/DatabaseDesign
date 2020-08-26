<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
<link rel='stylesheet' type='text/css' href='portalStyle.php' />
</style>
</head>

<body>
	<?php
	
	session_start();
	$newCourseOption;
	$assignedCourse;
	//Master script that stores log in session information
	//Turned into brain script that controls most of the critical functionality of the site
	//Most pages direct here when submitting content, before being redirected. Any session information is updated/stored here
	//In future will clean up redundancies. References to the database used multiple times, can be cleaned up
	
		function ProfileSelection(){
		//Default value for account type [Admin- 1, Teacher-0]	
		if($_SESSION['isLoggedIn'] == true){
			echo "Active username is: " . $_SESSION['User']; 

			$conn = mysqli_connect('localhost:3308','root','','user_database');

			if(isset($_POST['AdminProfile'])){
				echo"Admin profile assigned";
				$sql ="UPDATE acctTable SET isAdmin=1 WHERE userName= '" .$_SESSION['User'] . "' ";
				if(mysqli_query($conn,$sql)){
					$_SESSION['UserRole'] = 1;
				}
				else{
					echo"An error occurred when updating this profile";
				}
			}

			if(isset($_POST['TeacherProfile'])){
				echo"Teacher profile assigned";
				$sql ="UPDATE acctTable SET isAdmin=0 WHERE userName= '" .$_SESSION['User'] . "' ";
					if(mysqli_query($conn,$sql)){
						$_SESSION['UserRole'] = 0;
				}
				else{
					echo"An error occurred when updating this profile";
				}
			}
		}
	}
	
	function UpdateCourseAccess(){
		
		//Make this function update the course access for the specified user. Must get the user email and course selection from adminManage_Access.php
		$mysqli = NEW MySQLi('localhost:3308','root','','User_database');
		$resultCourse = $mysqli->query("SELECT course_name FROM Courses");
		
		while($rows = $resultCourse->fetch_assoc())
			{
				$course_name = $rows['course_name'];
				if(isset($Course) && $Course == "$course_name"){
						$activeCourse = str_replace(' ','',$course_name);
						echo "<p> The active course is $activeCourse";
				}
			}
		
			if($_SESSION['isLoggedIn'] == true){

				$conn = mysqli_connect('localhost:3308','root','','user_database');

				if(isset($_POST['CourseAccess'])){
					echo"Admin profile assigned";
					$sql ="UPDATE acctTable SET Course_Access='' WHERE userName= '" .$_SESSION['User'] . "' ";
					if(mysqli_query($conn,$sql)){
						//Do Nothing
					}
					else{
						echo"An error occurred when updating this profile";
					}
				}
		}
	}
	
	function RetriveInput(){
		//Updates the user's course access
		//In the future an option should be implmented for multi-course selection
		
		global $assignedCourse;
		$Course = $_POST["Course"];
		$conn = mysqli_connect('localhost:3308','root','','user_database');
		
		if(isset($_POST['UpdateCourse'])){
		
		//$mysqli = NEW MySQLi('localhost','gordonDefault','ScadSummer2020','CourseManager_database');
		$mysqli = NEW MySQLi('localhost:3308','root','','User_database');
		$resultCourse = $mysqli->query("SELECT course_name FROM Courses");
				
		// This is to get the active course to match the selection user specified. All for finding correct directory path
		while($rows = $resultCourse->fetch_assoc()){
			
				$course_name = $rows['course_name'];
				if(isset($Course) && $Course == "$course_name"){
						$activeCourse = str_replace(' ','',$course_name);
					//Here	
						$sql= "SELECT isAdmin FROM acctTable WHERE userName= '" . $_SESSION['User'] . "' ";
							$resultE = mysqli_query($conn,$sql);
							if(mysqli_num_rows($resultE)){

								while ($rows = mysqli_fetch_assoc($resultE)){

									if($rows['isAdmin'] == 1){
									$sql ="UPDATE acctTable SET Course_Access='".$activeCourse."' WHERE userName= '" . $_POST['UpdateCourse'] . "' ";
										echo $sql;
										if(mysqli_query($conn,$sql)){
											$_SESSION['UserRole'] = 0;
											echo "<script type='text/Javascript'> window.location.href='adminManage_Access.php'</script>";
											}
									}
									else{
										echo "<script type='text/Javascript'> alert('You do not have permission to update this profile')</script>";
										echo "<script type='text/Javascript'> window.location.href='TeacherConsole.php'</script>";
										}
									}
							}
						}
					
					//Here
					}
				}
		
		$assignedCourse = $activeCourse;
		
	}
	
	
	function ResetPassword(){
		$Oldpwd = $_POST['Opwd'];
		$Newpwd = $_POST['Npwd'];
		$Verifypwd = $_POST['Verifypwd'];
		$emailCheck = $_POST["emailCheck"];
		
		
		
		$conn = mysqli_connect('localhost:3308', 'root', '');
	
		if(!$conn){
			die("Connection failed: " . mysqli_connect_error());
		}
		
		else{ 
			mysqli_select_db($conn, 'user_database');
			$doesEmailExist = "SELECT Email, pwd FROM AcctTable WHERE Username= '" .$_SESSION['User'] . "' ";
				
					
			$resultE = mysqli_query($conn,$doesEmailExist);
			if(mysqli_num_rows($resultE) > 0){
				while ($rows = mysqli_fetch_assoc($resultE)){
						$emailUser = $rows['Email'];
						$origPass = $rows['pwd'];
					if($Newpwd == $Verifypwd){
						if(!empty($Newpwd) && $origPass == $Oldpwd && !empty($emailCheck) && $emailUser == $emailCheck){
							echo "Ame wa";
							$sql ="UPDATE acctTable SET pwd= '" .$_POST['Npwd'] . "'  WHERE userName= '" .$_SESSION['User'] . "' ";
							if(mysqli_query($conn,$sql)){
								echo "<script type='text/Javascript'> alert('Password Successfully updated')</script>";
								echo "<script type='text/Javascript'> window.location.href='login.php'</script>";
							}
						}
						else{
							echo "<script type='text/Javascript'> alert('An error occurred: <br> Check that your email and password match what we have on file')</script>";
								echo "<script type='text/Javascript'> window.location.href='login.php'</script>";
						}
					}
					
				}
		
			}
		}
	}
	
	
		function ResetUnknownUser(){
			//This is a duplicate of the original reset function for active user.
			//Had to make another one specifically for users that aren't logged in. Same logic but some variables are different
			//Will eventually optimize and combine the two functions into one
		$Oldpwd = $_POST['Opwd'];
		$Newpwd = $_POST['Npwd'];
		$Verifypwd = $_POST['Verifypwd'];
		$userCheck = $_POST["userCheck"];
		
		
		
		$conn = mysqli_connect('localhost:3308', 'root', '');
	
		if(!$conn){
			die("Connection failed: " . mysqli_connect_error());
		}
		
		else{ 
			mysqli_select_db($conn, 'user_database');
			$doesEmailExist = "SELECT Username, pwd FROM AcctTable";
				
					
			$resultE = mysqli_query($conn,$doesEmailExist);
			if(mysqli_num_rows($resultE) > 0){
				while ($rows = mysqli_fetch_assoc($resultE)){
						$User = $rows['username'];
						$origPass = $rows['pwd'];
						echo $User;
					foreach ($uSearch as $User){
						if($uSearch == $userCheck){
							echo "Eureka!!";
						}
					}
					if($Newpwd == $Verifypwd){
						if($origPass == $Oldpwd && !empty($userCheck) && $User == $userCheck){
							echo "Ame wa";
							$sql ="UPDATE acctTable SET pwd= '" .$_POST['Npwd'] . "'  WHERE userName= '" .$userCheck . "' ";
							if(mysqli_query($conn,$sql)){
								echo "<script type='text/Javascript'> alert('Password Successfully updated')</script>";
								echo "<script type='text/Javascript'> window.location.href='login.php'</script>";
							}
						}
						else{
						//	echo "<script type='text/Javascript'> alert('An error occurred: <br> Check that your username and password match what we have on file')</script>";
						//		echo "<script type='text/Javascript'> window.location.href='resetUnknownUser.php'</script>";
						}
					}
					
				}
		
			}
		}
	}
	
	
	
	function UpdateProfileGlobal(){
		//updates profile of a user regardless of whether or not they're logged in
		$conn = mysqli_connect('localhost:3308','root','','user_database');
		global $activeCourse;
		echo "The active course is: "  . $activeCourse ;
		
			if(isset($_POST['GlobalAdminProfile'])){
				echo"Global Admin profile assigned";
				
					$sql= "SELECT isAdmin FROM acctTable WHERE userName= '" . $_SESSION['User'] . "' ";
					$resultE = mysqli_query($conn,$sql);
					if(mysqli_num_rows($resultE)){
					while ($rows = mysqli_fetch_assoc($resultE)){
						
						if($rows['isAdmin'] == 1){
				
							$sql ="UPDATE acctTable SET isAdmin=1 WHERE userName= '" . $_POST['GlobalAdminProfile'] . "' ";
							if(mysqli_query($conn,$sql)){
								$_SESSION['UserRole'] = 1;
								echo "<script type='text/Javascript'> window.location.href='adminManage_Access.php'</script>";
							}
						}
						else{
							echo "<script type='text/Javascript'> alert('You do not have permission to update this profile')</script>";
							echo "<script type='text/Javascript'> window.location.href='TeacherConsole.php'</script>";
						}
					}
				}
				else{
					echo"An error occurred when updating this profile";
				}
			}

			if(isset($_POST['GlobalTeacherProfile'])){
				echo"Global Teacher profile assigned";
				
				$sql= "SELECT isAdmin FROM acctTable WHERE userName= '" . $_SESSION['User'] . "' ";
				$resultE = mysqli_query($conn,$sql);
				if(mysqli_num_rows($resultE)){
					while ($rows = mysqli_fetch_assoc($resultE)){
						if($rows['isAdmin'] == 1){
						$sql ="UPDATE acctTable SET isAdmin=0 WHERE userName= '" . $_POST['GlobalTeacherProfile'] . "' ";
							if(mysqli_query($conn,$sql)){
								$_SESSION['UserRole'] = 0;
								echo "<script type='text/Javascript'> window.location.href='adminManage_Access.php'</script>";
							}
						}
						else{
							echo "<script type='text/Javascript'> alert('You do not have permission to update this profile')</script>";
							echo "<script type='text/Javascript'> window.location.href='TeacherConsole.php'</script>";
						}
					}
				}
				else{
					
				}
			}
		//DropUser
		if(isset($_POST['Drop'])){
			
			$sql= "SELECT isAdmin FROM acctTable WHERE userName= '" . $_SESSION['User'] . "' ";
			$resultE = mysqli_query($conn,$sql);
			if(mysqli_num_rows($resultE)){
			while ($rows = mysqli_fetch_assoc($resultE)){
				if($rows['isAdmin'] == 1){
					//Input code to drop user
					echo " This was reached";
					$dropSql ="DELETE FROM `accttable` WHERE userName= '" . $_POST['Drop'] . "' ";
						if(mysqli_query($conn,$dropSql)){
								echo "<script type='text/Javascript'> alert('User has been deleted')</script>";
								echo "<script type='text/Javascript'> window.location.href='adminManage_Access.php'</script>";
						}
					}
				else{
						echo "<script type='text/Javascript'> alert('You do not have permission to delete this user')</script>";
						echo "<script type='text/Javascript'> window.location.href='TeacherConsole.php'</script>";
					}
				}
			}
		}
		
			//Drops a course
			if(isset($_POST['DropCourse'])){
			
			$sql= "SELECT isAdmin FROM acctTable WHERE userName= '" . $_SESSION['User'] . "' ";
			$resultE = mysqli_query($conn,$sql);
			if(mysqli_num_rows($resultE)){
			while ($rows = mysqli_fetch_assoc($resultE)){
				if($rows['isAdmin'] == 1){
					//Input code to drop user
					echo " This was reached";
					$dropSql ="DELETE FROM Courses WHERE course_name= '" . $_POST['DropCourse'] . "' ";
						if(mysqli_query($conn,$dropSql)){
								//Ideally you'd want to delete the coorsponding folders, but since there folders aren't empty this might not be safe. On pause for now
								//rmdir("studios/" . $_POST['DropCourse'] . "");
								echo "<script type='text/Javascript'> alert('Course " . $_POST['DropCourse'] . " has been deleted')</script>";
								
								echo "<script type='text/Javascript'> window.location.href='adminManage_Access.php'</script>";
						}
					}
				else{
						echo "<script type='text/Javascript'> alert('You do not have permission to delete this user')</script>";
						echo "<script type='text/Javascript'> window.location.href='TeacherConsole.php'</script>";
					}
				}
			}
		}
		
		
		//Change Course Assignment
		if(isset($_POST['UpdateCourse'])){
			
			$sql= "SELECT isAdmin FROM acctTable WHERE userName= '" . $_SESSION['User'] . "' ";
				$resultE = mysqli_query($conn,$sql);
				if(mysqli_num_rows($resultE)){
					
					while ($rows = mysqli_fetch_assoc($resultE)){
						
						if($rows['isAdmin'] == 1){
						$sql ="UPDATE acctTable SET Course_Access=".$activeCourse." WHERE userName= '" . $_POST['UpdateCourse'] . "' ";
							echo $sql;
							if(mysqli_query($conn,$sql)){
								$_SESSION['UserRole'] = 0;
								//echo "<script type='text/Javascript'> window.location.href='adminManage_Access.php'</script>";
							}
						}
						else{
							echo "<script type='text/Javascript'> alert('You do not have permission to update this profile')</script>";
							echo "<script type='text/Javascript'> window.location.href='TeacherConsole.php'</script>";
						}
					}
		}
	}
	}
	
	
	
	
	
	function addUserFolder(){
			$newCourse = $_SESSION['NewCourseName'];
			if(file_exists("studios/" . $newCourse))
			{
				//Do Nothing	
			}
			else
			{
				mkdir("studios/" . $newCourse);
				mkdir("studios/" . $newCourse . "/Lesson1");
				mkdir("studios/" . $newCourse . "/Lesson1/Primer");
				mkdir("studios/" . $newCourse . "/Lesson1/Plan");
				mkdir("studios/" . $newCourse . "/Lesson1/Worksheet");
				mkdir("studios/" . $newCourse . "/Lesson1/Powerpoint");
				mkdir("studios/" . $newCourse . "/Lesson1/Videos");
			}
		}
	
	function ProcessEntry($Item, $SubmitItem, $ItemName, $tableName){
		// The 'Item' as dictated by the chosen variables asking whether you want this function to work for 'Courses' or 'Lessons'
		// Updates table with new course/lessons
		global $newCourseOption;
			if(isset($_POST[$SubmitItem])){
								if($newCourseOption == true){
										$newItem = $_SESSION['NewCourseName']; 
								}else{
									$newItem = $_SESSION['NewLessonName']; 
								}
							
								$User = $_SESSION['User'];
										//$conn = mysqli_connect('localhost','gordonDefault','ScadSummer2020');
										$conn = mysqli_connect('localhost:3308','root','');

										if(!$conn){
											die("Connection failed: " . mysqli_connect_error());
										}

										else{ 
												//mysqli_select_db($conn, 'CourseManager_database');
												mysqli_select_db($conn, 'user_database');
											
												$doesEntryExist = "SELECT " . $Item . "_name FROM " . $tableName . " WHERE " .$Item ."_name = '$newItem'";
											
											echo $doesEntryExist;
													
												$result = mysqli_query($conn,$doesEntryExist);

												$addEntry = "INSERT INTO $tableName (" . $Item . "_name, created_on, user_name) VALUES ('$newItem', '8/22/2020', '$User') "; 
											
												$dataCheck = mysqli_num_rows($result);
											
												echo "This number is: " . $dataCheck;	

											if($result){
												if( mysqli_num_rows($result) > 0){
													echo "<script type='text/Javascript'> alert('This entry already exists')</script>";
													echo "<script type='text/Javascript'> window.location.href='AdminConsole.php'</script>";
												}
												else{
														if($conn->query($addEntry) === TRUE){
															addUserFolder();
															echo "New entry added";
															echo "<script type='text/Javascript'> window.location.href='AdminConsole.php'</script>";
														}
													}	
												}
										}
										
							}
	}
	
		function StoreNewEntries(){
			global $newCourseOption;
		if(isset($_POST['NewCourseSubmit'])){
			$newCourseOption = true;
			$_SESSION['NewCourseName'] = $_POST['newCourseText']; 
			ProcessEntry('course','NewCourseSubmit',$_SESSION['NewCourseName'], 'Courses');
			
		}
		
		if(isset($_POST['NewLessonSubmit'])){
			$_SESSION['NewLessonName'] = $_POST['newLessonText']; 
			ProcessEntry('lesson','NewLessonSubmit',$_SESSION['NewLessonName'], 'Lessons');	
		}
	}
	
	
	function StoreSelection(){
		//Suppose to work with Teacher profile. Goal is to store the user's choice path(full folder path of course) in a global var, so it can be called later. 
		$activeCourse;
		$activeLesson;
		$activeFile;
		
		//$mysqli = NEW MySQLi('localhost','gordonDefault','ScadSummer2020','CourseManager_database');
		$mysqli = NEW MySQLi('localhost:3308','root','','User_database');
		$resultCourse = $mysqli->query("SELECT course_name FROM Courses");
		$resultLesson = $mysqli->query("SELECT lesson_name FROM Lessons");
		$resultFile = $mysqli->query("SELECT file_name FROM Files");
		
		if(isset($Course) && $Course == "Blank")
		{
			echo "<h3>It seems you didn't select a valid course</h3>";
			validateInput($Course, "Course Selection");		
		}	
		
		if(isset($Lesson) && $Lesson == "Blank")
		{
			echo "<h3>It seems you didn't select a valid lesson</h3>";
			validateInput($Lesson, "Lesson Selection");		
		}	
		
		if(isset($File) && $File == "Blank")
		{
			echo "<h3>It seems you didn't select a file destination</h3>";
			validateInput($File, "File Selection");		
		}	
		
		// This is to get the active course to match the selection user specified. All for finding correct directory path
		while($rows = $resultCourse->fetch_assoc())
			{
				$course_name = $rows['course_name'];
				if(isset($Course) && $Course == "$course_name"){
						$activeCourse = str_replace(' ','',$course_name);
						echo "<p> The active course is $activeCourse";
				}
			}
		
		// This is to get the active lesson to match the selection user specified. All for finding correct directory path
		while($rows = $resultLesson->fetch_assoc())
			{
				$lesson_name = $rows['lesson_name'];
				if(isset($Lesson) && $Lesson == "$lesson_name"){
						$activeLesson = str_replace(' ','',$lesson_name);
						echo "<p> The active lesson is $activeLesson";
				}
			}
		
		while($rows = $resultFile->fetch_assoc())
			{
				$file_name = $rows['file_name'];
					if(isset($File) && $File == "$file_name"){
						$activeFile = str_replace(' ','',$file_name);
						echo "<p> The active file is $activeFile";
				}
			}
	}
	
	function UploadData(){
		global $activeCourse;
		global $activeLesson;
		global $activeFile;
		global $Destination;
		
		//Gets the current file destination path for the upload
		$Destination = "studios/" . $activeCourse . "/" . $activeLesson . "/" . $activeFile . "/";
		echo $_SESSION['TargetDirectory'];
	}
	
	
	
	function OpenFiles(){
		$filename = $_SESSION['TargetDirectory']; 
  
	// Header content type 
	header("Content-type: application/pdf"); 

	header("Content-Length: " . filesize($filename)); 

	// Send the file to the browser. 
	readfile($filename); 
	}
	
	function SignOff(){
		if(isset($_POST['Logout'])){
			$_SESSION['isLoggedIn'] = false;
			$_SESSION['User'] = '';
			$_SESSION['Email'] = '';
			$_SESSION['FirstName'] = '';
			$_SESSION['LastName'] = '';
			
			echo "<script type='text/Javascript'> window.location.href='landing.php'</script>";
		}
	}
	
	function ShowHomePage(){
		?>
		<p>
			<form action = "AdminConsole.php">
			<input type="submit" value="Go to next page">	
			</form>
		</p>
		<?php
	}
	
	function Start(){
		SignOff();
		ProfileSelection();
		StoreNewEntries();
		UpdateCourseAccess();
		UpdateProfileGlobal();
		ShowHomePage();
		RetriveInput();
		if(isset($_POST['ResetPass'])){
			//RedirectUser();  <--- Slight bug with this function, will work on it
			ResetPassword();
		}
		if(isset($_POST['ResetUnknownPass'])){
			//RedirectUser();  <--- Slight bug with this function, will work on it
			ResetUnknownUser();
		}
		if(isset($_POST['GrabFile'])){
			//RedirectUser();  <--- Slight bug with this function, will work on it
			StoreSelection();
			UploadData();
		}
	}
	
	Start();
	
	
	?>
</body>
</html>