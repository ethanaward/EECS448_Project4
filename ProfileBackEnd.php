<?php

session_start();
include "src/Profile.php";

$profile = new Profile();

$profile->display();

 ?>
