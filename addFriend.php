<?php

session_start();

include "src/Follow.php";

$follow = new Follow();

if(isset($_SESSION['friend'])) {
  echo "<script> alert('test');</script>";

  $follow->addFriend($_SESSION['username'], $_SESSION['friend']);
  $follow->close();

  unset($_SESSION['friend']);

  header("Location: ProfileFrontEnd.html", TRUE, 303);
}

?>
