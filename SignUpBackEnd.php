<?php

	$mysqli = new mysqli("mysql.eecs.ku.edu", "", "", "");

	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$email = $_POST["email"];
	$password = $_POST["passwordFirst"];

$sql = "INSERT INTO EECSUsers (FirstName, LastName, Email, Password) VALUES ('$firstName', '$lastName', '$email', '$password')";

if($mysqli->query($sql) === TRUE) {
	echo "New record created successfully";
	}
else{
	echo "Error: " . $sql . "<br>" . $mysqli->error;
}

}
/* close connection */
$mysqli->close();


?>
