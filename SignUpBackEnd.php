<?php

session_start();
include "SignUp.php";

$signup = new SignUp();

$signup->runQuery();
 ?>