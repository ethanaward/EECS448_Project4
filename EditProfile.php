<?php

session_start();
$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

$email = $_POST['email'];
$firstname = $_POST['firstName'];
$lastname = $_POST['lastName'];

if($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

$query = "UPDATE EECSUsers SET Email='$email', FirstName='$firstname', LastName='$lastname' WHERE user_id='".$_SESSION['username']."'";

if($mysqli->query($query)) {

}


  else
  {
    echo "Error: <br>" . $mysqli->error;
  }

$mysqli->close();
header("Location: ProfileFrontEnd.html", TRUE, 303);
?>
