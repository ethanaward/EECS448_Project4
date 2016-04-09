<?php
  session_start();

include "src/SignUp.php";

$signup = new SignUp();

$signup->runQuery();

?>