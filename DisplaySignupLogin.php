
<?php

/**
*	@file : DisplaySigupLogin.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Displays links for sign up and login
*/

if(!isset($_SESSION['username'])) {
  echo "<li><a href='SignUpFrontEnd.html'>Sign Up</a></li>
  		<li><a href='LoginFrontEnd.html'>Login Page</a></li>";
}
?>
