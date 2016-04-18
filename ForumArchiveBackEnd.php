

<?php



/**

*	@file : FeedBackEnd.php

*	@author : Mike Neises, Travis Augustine, Ethan Ward

*	@date : 2016.04.08

*	@brief: Creates new ForumArchive object

*/



session_start();

include "src/ForumArchive.php";



$feed = new ForumArchive();



$feed->display();

$feed->close();



 ?>
