<?php

echo "<li><a href = 'index.html'>Home</a></li>";
if(!isset($_SESSION['username'])) {
  echo "<li><a href='SignUpFrontEnd.html'>Sign Up</a></li>
  		<li><a href='LoginFrontEnd.html'>Log In</a></li>";
}

else {
  echo "<li><a href='LogoutBackEnd.php'>Log Out</a></li>";
  printf ("<li><a href = 'ProfileFrontEnd.html?profile=%s'>Your Profile</a></li> \n", $_SESSION['username']);
}

echo "<li><a href='ForumArchiveFrontEnd.html'>Forum</a></li>";

if(isset($_SESSION['forumname'])) {
	printf ("<a href = 'ForumFrontEnd.html?forumID=%s'>Back to %s</a> \n", $_SESSION['forumname'], $_SESSION['forumname']);
}

?>
