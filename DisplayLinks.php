<?php
/**
*	@file : DisplayLinks.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.05.04
*	@brief: Prints navigation links
*/
echo "<li><a href = 'index.html'>Home</a></li>";
if(!isset($_SESSION['username'])) {
  echo "<li><a href='SignUpFrontEnd.html'>Sign Up</a></li>
  		<li><a href='LoginFrontEnd.html'>Log In</a></li>";
}

else {
  echo "<li><a href='LogoutBackEnd.php'>Log Out</a></li>";
  printf ("<li><a href = 'ProfileFrontEnd.html?profile=%s'>Your Profile</a></li> \n", $_SESSION['username']);
  echo	"<li><a href = 'MainFeed.html'>Main Feed</a></li>";
}
echo	"<li class='dropdown'>";
echo	"<a class = 'dropdown' href='ForumArchiveFrontEnd.html'>Forum</a>";
echo	"<div class='dropdown-content'>";

			$user = $_SESSION["username"];

			$query = "SELECT * FROM EECSForums";

			$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
			if ($result = $mysqli->query($query))

			{
while ($row = $result->fetch_assoc())
	{
		printf ("<a href = 'ForumFrontEnd.html?forum=%s'>%s</a>", $row["forum_id"],$row["forum_id"]);
	}
	}
echo	"</div>";
echo	"</li>";

?>