<?php

session_start();

include "src/Follow.php";
$follow = new Follow();

if( isset( $_POST['Forum']) ) {

  if(isset($_GET['action'])) {

    if($_GET['action'] == 1) {
      $follow->addForum($_SESSION['username'], $_POST['Forum']);
      $follow->close();
      header("Location: ForumArchiveFrontEnd.html", TRUE, 303);

    }

    else if($_GET['action'] == 2) {
      $follow->removeForum($_SESSION['username'], $_POST['Forum']);
      $follow->close();
      header("Location: ForumArchiveFrontEnd.html", TRUE, 303);

    }

    else  {
      header("Location: ForumArchiveFrontEnd.html", TRUE, 303);
    }

  }
}
?>
