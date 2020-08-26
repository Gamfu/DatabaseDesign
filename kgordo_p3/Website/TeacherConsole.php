<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Teacher Console</title>

<link rel='stylesheet' type='text/css' href='portalStyle.php' />	
<link rel='stylesheet' type='text/css' href='portal.php' />

	
</head>

<body>
	<?php
	session_start();
	echo "<div id='topMenuer'>
			<form action='userSession.php' method='post' id='profileSelect'> </form>

			<div class='dropdown'>
		";
	if($_SESSION['isLoggedIn'] == true){
	
				//$conn = NEW MySQLi('localhost','gordonDefault','ScadSummer2020','CourseManager_database');
				$conn = NEW MySQLi('localhost:3308','root','','user_database');

				$resultCourse = $conn->query("SELECT course_access FROM AcctTable WHERE Username= '" .$_SESSION['User'] . "' ");
				$resultLesson = $conn->query("SELECT lesson_name FROM Lessons");
				$resultFile = $conn->query("SELECT file_name FROM Files");

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
	
	<div id="sideMenu">
		<button onclick="document.location='AdminConsole.php'" class='NavBtn' href='AdminConsole.php' type='submit' form='adminSelect' name='AdminProfile' value='Submit'>Admin</button>
		<button onclick="document.location='TeacherConsole.php'" style='padding-left:12%; padding-right:12%;' class='NavBtn' href='TeacherConsole.php' type='submit' form='teacherSelect' name='TeacherProfile' value='Submit'>Teacher</button>
	</div>
		
	<div id='ContentContain'>
	<h2 class='pageTitle'>Teacher Portal</h2><br>
	<h2>Which lesson do you want to look up?</h2><br>
	<div id="Users" style="width:100%;"> 
		
<form name="File Manager" 
			action="TeacherConsole.php"
			method="post"
	  		enctype="multipart/form-data"
	  		>
	  
	
	
				<div id="Section1" style=margin-top:2%> 
					<h2 style='color:#2CD5A7'>Course Selection</h2>
					   <select id= "CourseSelection" name="Course">
							<?php 
						   echo  "<option value='Blank' >Select course</option>";
						 //  echo "<option value='$resultCourse'>$resultCourse</option>";
								while($rows = $resultCourse->fetch_assoc())
								{
									$course_name = $rows['course_access'];
									$activeCourse = str_replace(' ','',$course_name);
									echo "<option value='$course_name'>$course_name</option>";
								 } 		
							echo "<option value='New' >Add new course</option>";
							?>
						</select>
				  </div>
		
				<div id="Section2"> 
					<h2 style='color:#2CD5A7' >Lesson Selection</h2>
					 <select id= "LessonSelection" name="Lesson">
						  <?php 
							echo  "<option value='Blank' >Select lesson</option>";
							while($rows = $resultLesson->fetch_assoc())
							{
								$lesson_name = $rows['lesson_name'];
								$activeLesson = str_replace(' ','',$lesson_name);
								echo "<option value='$lesson_name'>$lesson_name</option>";
							 }
						 echo "<option value='New' >Add new lesson</option>";
						?>
					</select>
				</div>
	  
			<div id="Section3"> 
				<h2 style='color:#2CD5A7'>File Destination Selection</h2>
				 <select id= "FileSelection" name="File">
						<?php 
						echo  "<option value='Blank' >Select file type</option>";
						while($rows = $resultFile->fetch_assoc())
						{
							$file_name = $rows['file_name'];
							$activeFile = str_replace(' ','',$file_name);
							echo "<option value='$file_name'>$file_name</option>";
						 }
						?>
				</select>
			</div>
		<?php
			$_SESSION['TargetDirectory'] = "studios/" . $activeCourse . "/" . $activeLesson . "/" . $activeFile . "/";
		?>
	</div>
	 <input class="buttonForm" style=margin-right:3% type="submit" name="GrabFile" value="Retrieve Content" />
	  
  	 
		  
	  </form>
<!--	
	<form>
    <select>
        <option selected="selected">Choose one</option>

        <?php
/*
		$folders = scandir('studios');
		$searchFolder = $folders;
		
		 foreach($searchFolder as $item){
		 echo "<option class='dropbtn' value='$item'>$item</option>";
        }
*/
        ?>

    </select>
	</form>	
-->
		</div>	
		</div>
	
</body>
</html>
