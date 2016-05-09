<?php
/**
*	@file : CreatePosts.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new Create object
*/
error_reporting(0);
session_start();
include "src/Create.php";

if(isset($_SESSION['username'])) {
	$create = new Create();
	if($_POST["isTopic"]==1)
	{
		$exist = $create->topicExists();
		if(!$exist)
		{
			$create->makePost();
			$_SESSION['message'] = "Post created!";
		}
		else
		{
	 		$_SESSION['message'] = "That topic already exists!";
		}
	}
	else
	{
		$create->makePost();
		$_SESSION['message'] = "Post created!";
	}
}

else {
  $_SESSION['message'] = "The post could not be created. You are not logged in.";
}
$create->close();
if($_GET['topic'] == 0) {
  header("Location: ForumFrontEnd.html", TRUE, 303);
}
else {
  header("Location: FeedFrontEnd.html", TRUE, 303);
}
?>
