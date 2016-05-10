<?php
/**
*	@file : DeleteUser.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.05.04
*	@brief: Deletes users from database at admin's request, then redirects
*/
include "../src/User.php";

$user = new User();

foreach($_POST['DeleteList'] as $check) {

  $user->deleteUser($check);

}
$user->close();

header("Location: ViewPosts.html", TRUE, 303);
?>
