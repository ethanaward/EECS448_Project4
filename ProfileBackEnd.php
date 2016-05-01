<?php

/**
*	@file : ProfileBackEnd.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new profile object
*/

session_start();
include "src/Profile.php";
include "src/Utility.php";

$profile = new Profile();
$util = new Utility();

$profile->display();
$profile->displayFollowed();

if(isset($_SESSION['username']))
{
	if(($_SESSION['username'] != $_SESSION['profilename']))
	{
		if(! ($util->checkFriend( $_SESSION['username'], $_SESSION['profilename'] )) )
		{
			echo "<form action = 'changeFriend.php?action=1' method = 'post'>";
			printf("<input type = 'hidden' name = 'Profile' value = '%s'>", $_SESSION['profilename']);
			echo "<button type = 'submit'>Add as friend</button>";
			echo "</form>";
		}

		else
		{
			echo "<form action = 'changeFriend.php?action=2' method = 'post'>";
			printf("<input type = 'hidden' name = 'Profile' value = '%s'>", $_SESSION['profilename']);
			echo "<button type = 'submit'>Remove as friend</button>";
			echo "</form>";
		}
	}
}

$profile->close();

 ?>
