<?php
/**
*	@file : LoginBackEnd.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new Login object
*/
session_start();

include "src/Login.php";

$user = new User();
$user->login();
$user->close();

?>
