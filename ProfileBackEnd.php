/**
*	@file : ProfileBackEnd.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new profile object
*/
<?php

session_start();
include "src/Profile.php";

$profile = new Profile();

$profile->display();

 ?>
