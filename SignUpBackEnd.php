<?php
  session_start();

	$mysqli = new mysqli("mysql.eecs.ku.edu", "eward", "ethanward", "eward");
	$username = $_POST["username"];
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$email = $_POST["email"];
	$password = $_POST["passwordFirst"];

		$sql = "INSERT INTO EECSUsers (user_id, FirstName, LastName, Email, Password) VALUES ('$username', '$firstName', '$lastName', '$email', '$password')";

		if($mysqli->query($sql))
		{
      $_SESSION['username'] = $username;
      $_SESSION['profilename'] = $username;
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $mysqli->error;
		}

/* close connection */
$mysqli->close();

header("Location: ProfileFrontEnd.html", TRUE, 303);
?>
