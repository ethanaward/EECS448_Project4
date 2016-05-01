<?php

session_start();

include "src/Follow.php";
$follow = new Follow();

if(isset($_GET['action']) && $_SESSION['username'] != $_SESSION['profilename']) {

  if($_GET['action'] == 1) {
      $follow->addFriend($_SESSION['username'], $_SESSION['profilename']);
      $follow->close();
      header("Location: ProfileFrontEnd.html", TRUE, 303);

  }

  else if($_GET['action'] == 2) {
    $follow->removeFriend($_SESSION['username'], $_SESSION['profilename']);
    $follow->close();
    header("Location: ProfileFrontEnd.html", TRUE, 303);

  }

}

?>
