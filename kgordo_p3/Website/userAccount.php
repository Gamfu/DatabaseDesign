<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
@import url("FinaCSS.css");
</style>
</head>

<body>
	<?php
	
		//Content for this page is good so far, styling is needed
		//This script is for setting up a new user, tied to the landing page
		//Need to figure out how to store password hash and retrieve information successfully
	
	function displayNameRequired($fieldName){
		echo "<h3>A valid entry in the \"$fieldName\" field is required </h3>";
	}
	
	function inconsistentValue($fieldName){
		echo "<h3>The value \"$fieldName\" does not match </h3>";
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
	
	function ShowHomePage(){
		?>
		<p>
			<form action = "landing.php">
			<input type="submit" value="Try Again?">	
			</form>
		</p>
		<?php
	}
	
	
	
	$fName = validateInput($_POST['firstName'], '<b>Enter First Name</b>');
	$lName = validateInput($_POST['lastName'], '<b>Enter Last Name</b>');
	$userName = validateInput($_POST['userName'], '<b>Enter Username</b>');
	$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
	$Cemail = $_POST['emailConfirm'];
	$pwd = $_POST['pwd'];
	$Cpwd = $_POST['pwdConfirm'];
	$emailCheck;
	$verifyEmail;
	$errorCount = 0;
	
	$ServName = "localhost:3308";
	$ServUser = "root";
	$ServPass = "";
	$databaseName = "user_database";
	
	session_start();
	$_SESSION['User'] = $userName;
	$_SESSION['Email'] = $email;
	$_SESSION['FirstName'] = $fName;
	$_SESSION['LastName'] = $lName;
	$_SESSION['isLoggedIn'] = false;
	
	function SubmitContent(){
		global $fName;
		global $lName;
		global $userName;
		global $email;
		global $Cemail;
		global $pwd;
		global $Cpwd;
		
		if(!empty($email) && $email == $Cemail){
			echo "<br>Your email was stored successfully";
		}
		
		else{
			echo "Try again, your email was unsuccessful";
		}
		
		if(!empty($pwd) && $pwd == $Cpwd){
			echo "<br>Your password was stored successfully";
		}
		
		else{
		}
	}
	
	function RedirectUser(){
		//If user failed to input certain information, they will be redirected to the last page
		
			if (empty($email) || empty($fName) || empty($lName) || empty($userName) || empty($pwd)){
				echo "<script type='text/Javascript'> alert('Please fill out all required fields')</script>";
				echo "<script type='text/Javascript'> window.location.href='landing.php'</script>";
			}
		
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
	
	function BeginNewEntry(){		
			// Need to work on getting the user to be able to make new lessons and courses. This will eventually feed into the NewLessonTable function.
			global $ServName;
			global $ServUser;
			global $ServPass;
			global $databaseName;
			global $fName;
			global $lName;
			global $userName;
			global $email;
			global $pwd;
			
			$time = date('Y/m/d');
		
			$conn = mysqli_connect($ServName, $ServUser, $ServPass);
	
			if(!$conn){
				die("Connection failed: " . mysqli_connect_error());
			}
		
			else{ 
					mysqli_select_db($conn, $databaseName);
					$doesEmailExist = "SELECT email FROM AcctTable WHERE email = '$email'";
				
					$doesUserExist = "SELECT userName FROM AcctTable WHERE userName = '$userName'";
					
					$resultE = mysqli_query($conn,$doesEmailExist);
					$resultU = mysqli_query($conn,$doesUserExist);
				
					$addEntry = "INSERT INTO AcctTable (FirstName,LastName,Username,Email,Pwd, createOn) VALUES ('$fName','$lName','$userName', '$email','$pwd','CURRENT_DATE()')";
					
					$EmailCheck = mysqli_num_rows($resultE);
					$UserCheck = mysqli_num_rows($resultU);
				
				if($resultE || $resultU){
					if( mysqli_num_rows($resultE) || mysqli_num_rows($resultU) > 0){
								echo "<br> This entry already exists";
								echo "<br> Please use the \"Back\" button to re-enter the data";
								ShowHomePage();
					}
						else{
							
								$_SESSION['isLoggedIn'] = true;
							
								if($conn->query($addEntry) === TRUE){
									echo"<br>";
									echo "New entry added";
									echo "User: " .$_SESSION['User'];
									echo "<h1>Select your account type</h1>";
									echo "<form action='userSession.php' method='post' id='profileSelect'> </form>";
									echo "<button type='submit' form='profileSelect' name='AdminProfile' value='Submit'>Admin</button>";
									echo "<button type='submit' form='profileSelect'  name='TeacherProfile' value='Submit'>Teacher</button>";
								}
							}	
				}
			}		
		
		}
	
	
		function Start(){
			// Need to verify methodology of this email method
			global $email;
			global $errorCount;
			
							if (filter_var($email, FILTER_VALIDATE_EMAIL)){
									global $emailCheck;
									$emailCheck = true;
								}

							if (empty($email)){
								displayNameRequired("E-mail");
								++$errorCount;
							}

							else if (!empty($email)  && (!filter_var($email, FILTER_VALIDATE_EMAIL))){
								displayNameRequired("E-mail");
								++$errorCount;
							}
			
		if(isset($_POST['Submit'])){
			RedirectUser();
			SubmitContent();
			BeginNewEntry();
			
		}
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