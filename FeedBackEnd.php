<?php
/**
	Author: Michael Neises, Travis Augustine
	Date Modified: April 6, 2016
	Purpose: to display all post content
**/
session_start();

//This variable is used to store the user_id of the poster
$user = $_POST["user"];

//This is the main html display for the feed.
//You can place new, additional titles here in the future
echo "<h1>Main Feed</h1>";

//Initialize the database connection
$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

//Here we select all things from the EECSPosts database.
$query = "SELECT * FROM EECSPosts";

if ($result = $mysqli->query($query)) {
    /* fetch associative array */
    
    //Here we display the posts with the related username, which also serves as a link to their profile page.
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
    	echo "<br>";
        printf ("%s \n", $row["content"]);
        echo "<br>-";
        printf ("<a href = 'ProfileFrontEnd.html?profile=%s'>%s</a> \n", $row["user_id"],$row["user_id"]);
        echo "<br>";
    }
    echo "</ul>";

    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();

?>
