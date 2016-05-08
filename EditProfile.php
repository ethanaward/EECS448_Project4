<?php
/**
*	@file : EditProfile.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new Edit object
*/
session_start();
include "src/Edit.php";
$edit = new Edit();
$edit->editProfile();
$edit->close();
$edit->redirectPage();


?>
