
<?php
/**
*	@file : DisplayLogoutLink.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Displays logout link
*/

 if(isset($_SESSION['username'])) {
  echo "<li><a href='LogoutFrontEnd.html'>Log Out</a></li>";
} ?>
