<?php

$mysqli = new mysqli("mysql.eecs.ku.edu", "eward", "ethanward", "eward");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$username = $_POST["username"];
$password = $_POST["password"];

$my_query = "SELECT * FROM EECSUsers WHERE user_id = '$username'";
$result = mysqli_query($mysqli, $my_query);
$row_num = mysqli_num_rows($result);

if($row_num == 1)
{
	header("Location: http://people.eecs.ku.edu/~mneises/448/Tests/ProfileFrontEnd.html", TRUE, 303);
}
else
{
	echo "Error: Username does not exist";

}

/* close connection */
$mysqli->close();


?>
