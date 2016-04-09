<?php

session_start();
include "Feed.php";

$feed = new Feed();

$feed->display();

 ?>