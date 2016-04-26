
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

if($_SESSION['username'] != $_SESSION['profilename']) {
  if(! ($util->checkFriend( $_SESSION['username'], $_SESSION['profilename'] )) ) {
    $_SESSION['friend'] = $_SESSION['profilename'];
    echo "<br><br>";
    echo "<form action = 'addFriend.php'>";
    echo "<button type = 'submit'>Add as friend</button>";
    echo "</form>";
  }
  else {
    echo "<br><br>";
    echo "<p>Added as friend</p>";
  }
}

$profile->close();

 ?>
