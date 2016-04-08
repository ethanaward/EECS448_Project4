<?php
session_start();
/*
* Author: Michael Neises
* Date Modified: April 8, 2016
* Purpose: to add a post to the EECSPosts database
*/

//These two variables hold the post content and the username of the poster respectively.
$post = $_POST["mypost"];
$user = $_POST["user"];
//This variable is used to see if the user_id exists within the EECSUsers database.
$here = false;

//Here we initialize the connection to the database.
$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

//Here I escape the post return into a correctly formatted string.
//Example: without this line, if the post contains a single apostrophe ("I'm coding."),
//Then that apostrophe will confuse the query and the program crashes.
$post = $mysqli->real_escape_string($post);


/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

//This query we will use to add the post with the username into the EECSPosts database.
$query = "INSERT INTO EECSPosts (content, user_id) VALUES('$post', '$user')";
//This quere we will use to select all user_id from the EECSUsers databse.
$exists = "SELECT user_id FROM EECSUsers";

//We try the query called "exists"
if ($result = $mysqli->query($exists)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
                
                //Try to match each user_id in the database to the username given by input.
                if ($row["user_id"]==$user){
                        //If that user_id exists, set $here to true.
                        $here = true;
                }
    }

    /* free result set */
    $result->free();
}

//See echos for explanations inside this conditional.
if($user==""){
        echo "Post not saved! Please enter a username!";
} else if($post==""){
        echo "Post not saved! Please enter a post!";
} else if(!$here) {
        echo "Post not saved! That username does not exist!";
} else if($mysqli->query($query)===TRUE) {
        echo "New post created successfully!";
} else {
        echo "Error: ".$query."<br>".$mysqli->error;
}

/* close connection */
$mysqli->close();

?>
<!--
    In this html section, we simply provide a link back to the feed.
-->
<html>
        <head>
                <title>EECSForum Main Feed</title>
                <style></style>
        </head>
        <body>
                <br><br>
                <a href="FeedFrontEnd.html">Back</a>
        </body>
</html>
