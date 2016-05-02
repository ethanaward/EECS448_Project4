<?php

include "../src/Create.php";

$post = new Create();

foreach($_POST['DeleteList'] as $check) {

  $post->deletePost($check);

}
$post->close();

header("Location: ViewPosts.html", TRUE, 303);
?>
