<?php

$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

if($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

$query = "SELECT * FROM EECSUsers";

if($result = $mysqli->query($query)) {
  echo "<table>";
	while($row = $result->fetch_assoc()) {

		printf("<tr> <td>%s</td> <td>%s</td> <td>%s</td> <td>%s</td> </tr>", $row["user_id"], $row["Email"], $row["FirstName"], $row["LastName"]);
	}
  echo "</table>";
	$result->free();
}

$mysqli->close();

?>
