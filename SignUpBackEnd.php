<?php

/**
*	@file : SignUpBackEnd.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates a new SignUp object
*/
  session_start();

include "src/User.php";

$user = new User();

$user->signup();
$user->close();

?>