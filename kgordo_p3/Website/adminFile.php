<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel='stylesheet' type='text/css' href='portalStyle.php' />
</head>

<body>
	<?php
		//In future will clean up redundancies. References to the database used multiple times, can be cleaned up
		//This script controls most of the data related to viewing and making new course options
		//Also initializes file folders for users that don't have structures in place
		//Allows for the creation of folders whenever a new course is created
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

	
	function SetupDir(){
		if(file_exists("studios"))
		{
			//do nothing
		}
		else{
			mkdir("studios");
			mkdir("studios/AnimationWorld");
			mkdir("studios/AnimationWorld/Lesson1");
			mkdir("studios/AnimationWorld/Lesson1/Primer");
			mkdir("studios/AnimationWorld/Lesson1/Plan");
			mkdir("studios/AnimationWorld/Lesson1/Worksheet");
			mkdir("studios/AnimationWorld/Lesson1/Powerpoint");
			mkdir("studios/AnimationWorld/Lesson1/Videos");
			
			mkdir("studios/FutureRealities");
			mkdir("studios/FutureRealities/Lesson1");
			mkdir("studios/FutureRealities/Lesson1/Primer");
			mkdir("studios/FutureRealities/Lesson1/Plan");
			mkdir("studios/FutureRealities/Lesson1/Worksheet");
			mkdir("studios/FutureRealities/Lesson1/Powerpoint");
			mkdir("studios/FutureRealities/Lesson1/Videos");
			
			mkdir("studios/DaltonInventors");
			mkdir("studios/DaltonInventors/Lesson1");
			mkdir("studios/DaltonInventors/Lesson1/Primer");
			mkdir("studios/DaltonInventors/Lesson1/Plan");
			mkdir("studios/DaltonInventors/Lesson1/Worksheet");
			mkdir("studios/DaltonInventors/Lesson1/Powerpoint");
			mkdir("studios/DaltonInventors/Lesson1/Videos");
		}
	}
	
	function addUserFolder(){
		global $newCourse;
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
	
	function addUserLesson(){
		global $activeCourse;
		global $newLesson;
		if(file_exists("studios/" . $activeCourse . "/" . $newLesson))
		{
			//Do Nothing
		}
		else
		{
			mkdir("studios/" . $activeCourse . "/" . $newLesson);
			mkdir("studios/" . $activeCourse . "/" . $newLesson . "/Primer");
			mkdir("studios/" . $activeCourse . "/" . $newLesson . "/Plan");
			mkdir("studios/" . $activeCourse . "/" . $newLesson . "/Worksheet");
			mkdir("studios/" . $activeCourse . "/" . $newLesson . "/Powerpoint");
			mkdir("studios/" . $activeCourse . "/" . $newLesson . "/Videos");
		}
	}
	
	function displayNameRequired($fieldName){
		echo "<h3>A valid entry in the \"$fieldName\" field is required </h3>";
	}
	
	function validateInput($data, $fieldName){
		global $errorCount; //this is for counting how many times the user failed to input name
		
		if(empty($data)){
			displayNameRequired($fieldName);
			++$errorCount;
			$retval = "";
		} 
		else{
			$retval = trim($data);
			$retval = stripslashes($retval);
		}
		return($retval);
	}
	
	$errorCount = 0;
	$Dir = "studios";
	
	//$newLesson = $_POST["newLesson"];  <---- Re-Add this when you get the Begin New Entry function finished
	
	$activeCourse;
	$activeLesson;
	$activeFile;
	//$fileStore = $_POST["upload"];  <--- I don't think this variable is needed. Will check later though
	$Destination;
	
	//variables for linking php server
	$severname = "localhost";
	$Susername = "gordonDefault";
	$password = "ScadSummer2020";
	$databaseName = "CourseManager_database";
	$date = date('Y/m/d');
	$time = date('h:i:sa');
	
	function ShowHomePage(){
		?>
		<p>
			<form action = "AdminConsole.php">
			<input type="submit" value="Try Again?">	
			</form>
		</p>
		<?php
	}
	
	function sqlConnection(){
			$conn = mysqli_connect($severname, $Susername, $password, $databaseName);
	
			if(!$conn){
				die("Connection failed: " . mysqli_connect_error());
			}

			echo "Connected Successfully";

			if(isset($_POST["Submit"]))
			{
				//$sql = "INSERT INTO RegistryTracker (Date,Time,Name,Email,Entry) VALUES ('$date', '$time','$userName','$email','++$EntryCount')";
				$result = $conn->query($sql);

				if($result === TRUE){
					echo "<br> Successfully uploaded the file";
				}
			}
	}
	
	function RetriveInput(){
		$Course = $_POST["Course"];
		$Lesson = $_POST["Lesson"];
		$File = $_POST["File"];
		global $activeCourse;
		global $activeLesson;
		global $activeFile;
		
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
		$TargetDirectory = $Destination . basename($_FILES["upload_file"]["name"]);
		if(isset($_POST['Submit'])){
				if(isset($Course) && $Course != "Blank" || isset($Lesson) && $Lesson == "Blank" || isset($File) && $File != "Blank"){ 
					//First we want to make sure the user isn't trying to make a new db entry. If they're making a new db entry, there'd be no file director to upload information to.
					if(move_uploaded_file($_FILES['upload_file']['tmp_name'], $TargetDirectory )){
						//chmod($Destination . basename($_FILES['upload_file']['name']) , 0644);
						//ShowHomePage();
						echo "File was uploaded Successfully";
					}
					else{
						//ShowHomePage();
						echo "There's an error with uploading this file";
					}
				}
			}
	}
	
	function BeginNewEntry(){		
			// Need to work on getting the user to be able to make new lessons and courses. This will eventually feed into the NewLessonTable function.
			$Course = $_POST["Course"];
			$Lesson = $_POST["Lesson"];
			global $newCourse;
			
			echo"<div id='Container'>"
					?>
					<div id="sideMenu">
						<button onclick="document.location='AdminConsole.php'" class='NavBtn' href='AdminConsole.php' type='submit' form='adminSelect' name='AdminProfile' value='Submit'>Admin</button>
		<button onclick="document.location='TeacherConsole.php'" style='padding-left:12%; padding-right:12%;' class='NavBtn' href='TeacherConsole.php' type='submit' form='teacherSelect' name='TeacherProfile' value='Submit'>Teacher</button>
					</div>

					<?php

		echo"<div id='ContentContain'>";
		echo"<h2 class='pageTitle'>Add New Options</h2><br>";
			PageContent();
		
				if(isset($Course) && $Course == "New")
					{
						
						echo "	
								<h1><b>Create New Course</b></h1>
								<div id='Users'> 
								<form name='NewDate' action='userSession.php' method='post'
								<p> <input size='125%' style='height:50px ;margin-top:2%; margin-left:2% ; float:left' type='text' placeholder='Enter Course Name'   name='newCourseText' /></p>
								<p><input class='buttonForm' style='float:right; margin:5%; margin-top:2%' type='submit' name='NewCourseSubmit' value='Submit' /></p>
								</form>
								</div> 
							";
					}
		
				if(isset($Lesson) && $Lesson == "New")
					{
						echo "
						
						<h1><b>Create New Lesson</b></h1>
						<div id='Users'>
						<form name='NewLesson' action='userSession.php' method='post'
						<p><input size='125%' style='height:50px ;margin-top:2%; margin-left:2% ; float:left' type='text' placeholder='Enter Lesson Name'  name='newLessonText' /></p>
						<input class='buttonForm' style='float:right; margin:5%; margin-top:2%'  type='submit' name='NewLessonSubmit' value='Submit' /></p>
						</form>
						</div> 
					
					";
					}
		echo"</div>";
		echo"</div>";
		}
	
		function NewLessonTable(){
			//https://www.youtube.com/watch?v=zYNAfEHGXAg
			
			//Will need to make a new table for each course lesson options
			
			//Should first check if the table exists, using the naming convention ' $activeCourse .'Lessons'
			
			//Then either user or make the active lesson table using the same convention ' $activeCourse .'Lessons'
			
			$mysqli = NEW MySQLi('localhost','gordonDefault','ScadSummer2020','CourseManager_database');
			
			$newCoursedb = "INSERT INTO Courses (course_name, created_on, user_name) VALUES (" . $newCourse . ", DATETIME(), Kevin Gordon) ";
			
			$newLessondb = "CREATE TABLE IF NOT EXISTS" . $activeCourse . 'Lessons' . "(" . $activeCourse . 'Lessons' . "_ID INT NOT NULL AUTO_INCREMENT, name VARCHAR(64), price DOUBLE, description SOMETHING, PRIMARY KEY(product_ID))";
			
			$result = mysqli_query($mysqli,$newdb) or die("Bad Create: $newdb");
		}
	
	function ProcessEntry($Item, $SubmitItem, $ItemName, $tableName){
		// The 'Item' as dictated by the chosen variables asking whether you want this function to work for 'Courses' or 'Lessons'
		// When adding a new lesson, the lesson number in the db should increment
		// The lesson should have a shorthand descriptor name, and that name is what will be dictated by this function
			if(isset($_POST[$SubmitItem])){
								
								$newItem = $_POST[$ItemName]; 
										//$conn = mysqli_connect('localhost','gordonDefault','ScadSummer2020');
										$conn = mysqli_connect('localhost:3308','root','');

										if(!$conn){
											die("Connection failed: " . mysqli_connect_error());
										}

										else{ 
												//mysqli_select_db($conn, 'CourseManager_database');
												mysqli_select_db($conn, 'user_database');
											
												$doesEntryExist = "SELECT" . $Item . "_name FROM $tableName WHERE " .$Item ."_name = $newItem";

												$result = mysqli_query($conn,$doesEntryExist);

												$addEntry = "INSERT INTO $tableName (" . $Item . "_name, created_on, user_name) VALUES ( '$newItem', '8/22/2020', 'Kevin Gordon') "; /* <-- Will need to replace my name with the username at some point */
											
												$dataCheck = mysqli_num_rows($result);

											if($result){
												if( mysqli_num_rows($result) > 0){
															ShowHomePage();
															echo "This entry already exists";
												}
												else{
														if($conn->query($addEntry) === TRUE){
															ShowHomePage();
															addUserFolder();
															echo "New entry added";
														}
													}	
												}
										}
										
							}
	}
	
	function PageContent(){
		
	
	if($_SESSION['isLoggedIn'] == true){
	
		//$conn = NEW MySQLi('localhost','gordonDefault','ScadSummer2020','CourseManager_database');
		$conn = NEW MySQLi('localhost:3308','root','','user_database');
			
		$resultCourse = $conn->query("SELECT course_name FROM Courses");
		$resultLesson = $conn->query("SELECT lesson_name FROM Lessons");
		$resultFile = $conn->query("SELECT file_name FROM Files");
		}
	?>
	
		<h2>Choose your upload source</h2><br>
	<div id="Users"> 
		
<form name="File Manager" 
			action="adminFile.php"
			method="post"
	  		enctype="multipart/form-data"
	  		>
	  
	
	
				<div id="Section1" style=margin-top:2%> 
					<h2 style='color:#2CD5A7'>Course Selection</h2>
					   <select id= "CourseSelection" name="Course">
							<?php 
						   echo  "<option value='Blank' >Select course</option>";
							?>
						</select>
				  </div>
		
				<div id="Section2"> 
					<h2 style='color:#2CD5A7' >Lesson Selection</h2>
					 <select id= "LessonSelection" name="Lesson">
						  <?php 
							echo  "<option value='Blank' >Select lesson</option>";
						?>
					</select>
				</div>
	  
			<div id="Section3"> 
				<h2 style='color:#2CD5A7'>File Destination Selection</h2>
				 <select id= "FileSelection" name="File">
						<?php 
						echo  "<option value='Blank' >Select file type</option>";
						?>
				</select>
			</div>
		
	
	  
  	 
		  
	  </form>
	</div>
	<?php
	}
				
	// Actionable scripts start below
	
	
//	NewEntry();
	
		function Start(){
		global $Destination;
		//ProcessEntry('course','NewCourseSubmit',$_SESSION['NewCourseName'], 'Courses');	
		//ProcessEntry('lesson','NewLessonSubmit',$_SESSION['NewLessonName'], 'Lesson');	
			
			
		if(isset($_POST['Submit'])){
			SetupDir();
			RetriveInput();
			UploadData();
			BeginNewEntry();
		}
	
		
		//Need to figure out a way to check if data already exist in table
	}
	
		if($errorCount > 0){
		//checks if the user failed to select a field, adds home button
		echo "Please use the \"Back\" button to re-enter the data";
		ShowHomePage();
		} 
		else{
			Start();
		}
	
	
	
	?>
</body>
</html>