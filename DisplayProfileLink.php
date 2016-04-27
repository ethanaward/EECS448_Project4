<?php 
/**
*	@file : DisplayProfileLink.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Displays profile link
*/

	if(isset($_SESSION['username'])) 
	{
		printf ("<li><a href = 'ProfileFrontEnd.html?profile=%s'>Your Profile</a></li> \n", $_SESSION['username']);
	}
	else
	{

	} 
?>