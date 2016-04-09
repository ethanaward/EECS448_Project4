<?php

session_start();
include "Create.php";

if(isset($_SESSION['username'])) {
  $create = new Create();

  $create->makePost();
}

else {
  echo "The post could not be created. You are not logged in.";
}


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
