<?php
/**
*	@file : DeletePost.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.05.04
*	@brief: Deletes selected posts from database at admin's request, then redirects
*/
include "../src/Create.php";

$post = new Create();

foreach($_POST['DeleteList'] as $check) {

  $post->deletePost($check);

}
$post->close();

header("Location: ViewPosts.html", TRUE, 303);
?>
