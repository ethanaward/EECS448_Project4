<?php
/**
*	@file : CreateForum.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.05.04
*	@brief: Adds a new forum to database at admin's request, then redirects
*/
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
