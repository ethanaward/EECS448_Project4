<?php

$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
$query = "INSERT INTO EECSForums (forum_id) VALUES ('". $_POST['Forum']."')";

if($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

	if($mysqli->query($query)) {
	}

$mysqli->close();

header("Location: ../Admin.html", TRUE, 303);
?>
