<?php

include "../src/User.php";

$user = new User();

foreach($_POST['DeleteList'] as $check) {

  $user->deleteUser($check);

}
$user->close();

header("Location: ViewPosts.html", TRUE, 303);
?>
