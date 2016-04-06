<?php

$user = $_POST["user"];

echo "<h1>Main Feed</h1>";

$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM EECSPosts";

if ($result = $mysqli->query($query)) {
    /* fetch associative array */
        echo "<ul>";
    while ($row = $result->fetch_assoc()) {
                echo "<br>";
        printf ("%s \n", $row["content"]);
                echo "<br>-";
        printf ("%s \n", $row["user_id"]);
                echo "<br>";
    }
        echo "</ul>";

    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();

?>
