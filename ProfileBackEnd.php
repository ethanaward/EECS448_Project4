<?php

$mysqli = new mysqli("mysql.eecs.ku.edu", "eward", "ethanward", "eward");

if($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

$query = "SELECT Email FROM EECSUsers WHERE user_id ='mike'";

if($result = $mysqli->query($query)) {

	$row = $result->fetch-assoc();
      printf("%s<br>", $row["Email]);

}
>
