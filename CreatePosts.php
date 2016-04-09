<?php

session_start();
include "Create.php";

$create = new Create();

$create->makePost();

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