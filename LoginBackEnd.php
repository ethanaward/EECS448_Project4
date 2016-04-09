<?php
session_start();

include "src/Login.php";

$login = new Login();

$login->run();

?>
