<?php

session_start();
include "src/Feed.php";

$feed = new Feed();

$feed->display();

 ?>