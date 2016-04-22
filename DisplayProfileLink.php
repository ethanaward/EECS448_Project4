
<?php 
/**
*	@file : DisplayProfileLink.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Displays profile link
*/

if(isset($_SESSION['username'])) {
  echo "<li><a href='ProfileFrontEnd.html'>Your Profile</a></li>";
} ?>
