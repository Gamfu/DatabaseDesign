<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
<link rel="stylesheet" type="text/css" href="portal.css">
</style>
</head>

<body>
	<?php
	session_start();
	
	// Controls information for user logging into a session
	// Need to work out how to reset a password for unknown user
	
	$userName = $_POST['userName'];
	$pwd = $_POST['pwd'];
	$ServName = "localhost:3308";
	$ServUser = "root";
	$ServPass = "";
	$databaseName = "user_database";
	
	function ShowHomePage(){
		?>
		<p>
			<form action = "login.php">
			<input type="submit" value="Go back">	
			</form>
		</p>
		<?php
	}
	
	function ShowNextPage(){
		?>
		<p>
			<form action = "AdminConsole.php">
			<input type="submit" value="Go to next page">	
			</form>
		</p>
		<?php
	}
	
	$conn = mysqli_connect($ServName, $ServUser, $ServPass, $databaseName);
	
			if(!$conn){
				die("Connection failed: " . mysqli_connect_error());
			}
	
			if(isset($_POST['SubmitLog'])){ 
				if(empty($_POST['userName']) || empty($_POST['pwd']) ){
					echo "<script type='text/Javascript'> alert('Please fill out both your username and password')</script>";
					echo "<script type='text/Javascript'> window.location.href='login.php'</script>";
				}		
				
				
				mysqli_select_db($conn,'user_database');
				//Checks the database to determine if a user with the specified username & password exists
				$doesUserExist = "SELECT * FROM AcctTable WHERE Username = '$userName' and Pwd='$pwd'";
				$result = mysqli_query($conn,$doesUserExist);
				$findUserInfo = $conn->query("SELECT * FROM AcctTable WHERE Username = '$userName' and Pwd='$pwd'");
				
				echo "The number is " . mysqli_num_rows($result);
				
				if($result){
					if(mysqli_num_rows($result) == 1){
						echo "Login successful";
						
						while($rows = $findUserInfo->fetch_assoc()){
							//fetch all values from the queried row. Used to specify current user
								$_SESSION['User'] = $rows['Username'];
								$_SESSION['Email'] = $rows['Email'];
								$_SESSION['FirstName'] = $rows['FirstName'];
								$_SESSION['LastName'] = $rows['LastName'];
								$_SESSION['AcctType'] = $rows['isAdmin'];
								$_SESSION['isLoggedIn'] = true;
							}
						if($_SESSION['AcctType'] == 1){
							echo "<script type='text/Javascript'> window.location.href='AdminConsole.php'</script>";
						}
						else{
							echo "<script type='text/Javascript'> window.location.href='TeacherConsole.php'</script>";
						}
						
					}
					else{
						echo "<script type='text/Javascript'> alert('This user does not exist')</script>";
						echo "<script type='text/Javascript'> window.location.href='login.php'</script>";
					}
				}
			}
	
		
			

			
	
	
	?>
</body>
</html>