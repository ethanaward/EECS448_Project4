/**
*	@file : LogoutBackEnd.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Destroys current session
*/
<?php
	session_start();
	session_destroy();

?>
