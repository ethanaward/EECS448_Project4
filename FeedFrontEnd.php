<?php
/*
* Author: Michael Neises
* Date Modified: April 8, 2016
* Purpose: to display the user posts and the associated
*/
session_start();

//This variable holds the posted user_id
$user = $_POST["user"];

//This is the main title for the post feed.
//Add additional titles here in the future.
echo "<h1>Main Feed</h1>";

//Initialize the connection to the database
$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

//Here we select everything from the posts database.
$query = "SELECT * FROM EECSPosts";


if ($result = $mysqli->query($query)) {
    /* fetch associative array */
    
    //Here we display all the post and the associated username, which also serves as a link to that user's profile page.
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

<!--
    In this html section we display the forms for the post input and the associated username
    In the future this can be updated to automatically post the username by way of login persistence.
-->
<html>
        <head>
                <title>EECSForum Main Feed</title>
                <style></style>
        </head>
        <body>
                <br><br>
                <form id="myForm" action="CreatePosts.php" method="post">
                        <textarea rows="8" cols="100" name="mypost"></textarea><br>
                        Username:
                        <input type="text" name="user" maxlength="25" size="15">
                        <input type="submit" class="button" name="submit" value="Post">
                </form>

                <a href="">Profile</a>
        </body>
</html>
