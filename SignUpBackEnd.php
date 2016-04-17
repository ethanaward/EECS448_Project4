<?php

/**
*	@file : SignUpBackEnd.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates a new SignUp object
*/
  session_start();

include "src/SignUp.php";

$signup = new SignUp();

$signup->runQuery();
$signup->close();

?>
