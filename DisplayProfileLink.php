/**
*	@file : DisplayProfileLink.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Displays profile link
*/
<?php if(isset($_SESSION['username'])) {
  echo "<a href='ProfileFrontEnd.html'>Your Profile</a>
  <br>";
} ?>
