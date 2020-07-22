<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Career Database</title>
 <link href="exStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
	
	<div id="Container">
	
	<?php
	
	function displayRequired($fieldName){
		echo "<h3>This field \"$fieldName\" is required. </h3><br>";
	}
	
	function validateInput($data, $fieldName){
		global $errorCount; //this is for counting how many times the user failed to input name
		
		if(empty($data)){
			displayRequired($fieldName);
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
	$userName = validateInput($_POST["fullName"], "<b>Enter Name</b>");
	
	//The function below uses advanced escaping to temp switch to an html form for showing homepage
	
	function ShowHomePage(){
		?>
		<p>
			<form action = "csCareers.html">
			<input type="submit" value="Try Again?">	
			</form>
		</p>
		<?php
	}
		
	if($errorCount > 0){
		//checks if the user failed to select a field
		echo "Please use the \"Back\" button to re-enter the data";
		ShowHomePage();
	} 
	else {	
		echo "<h1>Hello, " . $userName . "</h1>" ;
		displayData();
	}  
	
	//The function below handles the data the will be displayed when the form is run
	
	function displayData()
	{
		$Career = $_POST["career"]; //Gets the values stored in the dropdown menu
		
		if(isset($Career) && $Career == "Blank"){
			echo "<h3>It seems you didn't select a valid career path</h3>";
			validateInput($Career, "Career Selection");
		}
		
		if(isset($Career) && $Career == "Digital Music"){
				echo "<h3> Here's your curated selection of CS " . $Career . " Pathways" . "<br></h3>";
					echo "<a href=http://getinmedia.com/careers/audio-technician> Be an Audio Technician </a><br><br>" ;
					echo "<a href=https://www.audioshapers.com/blog/what-is-sound-design.html> Discover the field of Sound Design </a><br><br>";
					echo "<a href=https://learn.org/articles/What_is_a_Radio_Broadcast_Engineer.html#:~:text=Radio%20broadcast%20engineers%20set%20up,they%20can%20to%20fix%20it.> Learn what it takes to be a Radio Broadcast Engineer </a><br><br>";
		}

		if(isset($Career) && $Career == "Software Engineer"){
				echo "<h3> Here's your curated selection of CS " . $Career . " Pathways" . "<br></h3>";
					echo "<a href=https://www.careerexplorer.com/careers/app-developer/> Want to be an App Developer </a><br><br>" ;
					echo "<a href=https://www.zippia.com/multimedia-developer-jobs/> Discover what Multimedia Developers do </a><br><br>";
					echo "<a href=https://www.bitdegree.org/tutorials/what-is-a-web-developer/> Learn what it takes to be a Radio Web Developer </a><br><br>";
		}

		if(isset($Career) && $Career == "Computer Arts"){
				echo "<h3> Here's your curated selection of CS " . $Career . " Pathways" . "<br></h3>";
					echo "<a href=https://www.gamedesigning.org/career/game-developer/> Learn the ins and outs of Game Development </a><br><br>" ;
					echo "<a href=https://www.careerexplorer.com/careers/industrial-designer/> Discover the field of Industrial Design </a><br><br>";
					echo "<a href=https://skillcrush.com/blog/what-is-digital-design/> Learn what it takes to be a Digital Designer </a><br><br>";
		}

		if(isset($Career) && $Career == "Data Science"){
				echo "<h3> Here's your curated selection of CS " . $Career . " Pathways" . "<br></h3>";
					echo "<a href=https://datasciencedegree.wisconsin.edu/data-science/what-do-data-scientists-do/> Discover what Data Scientist do </a><br><br>" ;
					echo "<a href=https://www.careerexplorer.com/careers/data-analyst/> Try learning about what Data Analyst do </a><br><br>";
					echo "<a href=https://www.dataversity.net/data-architect-vs-data-engineer/> Compare Data Science vs Data Engineer </a><br><br>";
		}

		if(isset($Career) && $Career == "Cyber Security"){
				echo "<h3> Here's your curated selection of CS " . $Career . " Pathways" . "<br></h3>";
					echo "<a href=https://www.comptia.org/blog/your-next-move-penetration-tester> Become an ethical hacker by discovering Systems Pentration Specialist do </a><br><br>" ;
					echo "<a href=https://www.comptia.org/blog/your-next-move-cybersecurity-engineer> Discover what it takes to be a Cybersecurity Engineer </a><br><br>";
					echo "<a href=https://www.comptia.org/blog/your-next-move-cybersecurity-specialist> Learn what it takes to be a Cyber Security Specialist </a><br><br>";
		}
		ShowHomePage(); //Return user to main page
	}
	
	?>
	
	</div>
</body>
</html>