<?php

session_start();
include "Profile.php";

$profile = new Profile();

$profile->display();

 ?>
