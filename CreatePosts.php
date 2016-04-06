<?php
session_start();

$post = $_POST["mypost"];
$user = $_POST["user"];
$here = false;

$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
$post = $mysqli->real_escape_string($post);


/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$query = "INSERT INTO EECSPosts (content, user_id) VALUES('$post', '$user')";
$exists = "SELECT user_id FROM EECSUsers";

if ($result = $mysqli->query($exists)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {
                if ($row["user_id"]==$user){
                        $here = true;
                }
    }

    /* free result set */
    $result->free();
}

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

<html>
        <head>
                <title>EECSForum Main Feed</title>
                <style></style>
        </head>
        <body>
                <br><br>
                <a href="http://people.eecs.ku.edu/~mneises/448/Tests/FeedFrontEnd">Back</a>
        </body>
</html>
