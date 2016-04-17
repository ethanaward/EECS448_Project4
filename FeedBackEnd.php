
<?php

/**
*	@file : FeedBackEnd.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new Feed object
*/

session_start();
include "src/Feed.php";

$feed = new Feed();

$feed->display();
$feed->close();

 ?>
