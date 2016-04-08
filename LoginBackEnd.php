<?php
session_start();

include "Login.php";

$login = new Login();

$login->run();

?>
