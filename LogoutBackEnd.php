
<?php

/**
*	@file : LogoutBackEnd.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Destroys current session
*/
	error_reporting(0);

	session_start();
	session_destroy();
?>
