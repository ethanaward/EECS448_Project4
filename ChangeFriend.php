<?php
/**
*	@file : ChangeFriend.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.05.04
*	@brief: Adds or removes friend at user's request
*/
session_start();

include "src/Follow.php";
$follow = new Follow();

if(isset($_POST['Profile'])) {
  if(isset($_GET['action']) && $_SESSION['username'] != $_POST['Profile']) {

    if($_GET['action'] == 1) {
      $follow->addFriend($_SESSION['username'], $_POST['Profile']);
      $follow->close();
      header("Location: ProfileFrontEnd.html", TRUE, 303);

    }

    else if($_GET['action'] == 2) {
      $follow->removeFriend($_SESSION['username'], $_POST['Profile']);
      $follow->close();
      header("Location: ProfileFrontEnd.html", TRUE, 303);

    }

    else  {
      header("Location: ProfileFrontEnd.html", TRUE, 303);
    }

  }
}
?>
