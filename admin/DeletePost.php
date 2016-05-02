<?php
$mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
if($mysqli->connect_errno) {
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}
echo "The following posts were deleted: <br>";
foreach($_POST['DeleteList'] as $check) {
	$query = "DELETE FROM EECSPosts WHERE post_id='$check'";
	echo "$check<br>";
	if($mysqli->query($query)) {
	}
}
$mysqli->close();

header("Location: ViewPosts.html", TRUE, 303);
?>
