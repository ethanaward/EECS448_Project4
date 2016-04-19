

<?php



/**

*	@file : FeedBackEnd.php

*	@author : Mike Neises, Travis Augustine, Ethan Ward

*	@date : 2016.04.08

*	@brief: Creates new Forum object

*/



session_start();

include "src/Forum.php";



$feed = new Forum();



$feed->display();

$feed->close();



 ?>
