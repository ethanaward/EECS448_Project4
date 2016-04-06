<?php

	$mysqli = new mysqli("mysql.eecs.ku.edu", "eward", "ethanward", "eward");
	$username = $_POST["username"];
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$email = $_POST["email"];
	$password = $_POST["passwordFirst"];
	if($username == "" || $firstname == "" || $lastname == "" || $email == "" || $password == "")
	{
		

	}
	else 
	{
		$sql = "INSERT INTO EECSUsers (user_id, FirstName, LastName, Email, Password) VALUES ('$username', '$firstName', '$lastName', '$email', '$password')";

		if($mysqli->query($sql) === TRUE) 
		{
			echo "New record created successfully";
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $mysqli->error;
		}
	}
/* close connection */
$mysqli->close();

header("Location: /ProfileFrontEnd.html", TRUE, 303);
?>
