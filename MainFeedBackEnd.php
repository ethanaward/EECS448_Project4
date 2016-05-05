<?php
		include "src/MainFeedDriver.php";
		$allPosts = new MainFeedDriver();
		$allPosts->display();
		$allPosts->close();

		/*
		include "src/myRecentPosts.php";
		$recentPosts = new myRecentPosts();
		$recentPosts->display();
		$recentPosts->close();

		include "src/FriendPosts.php";
		$FriendPosts = new FriendPosts();
		$FriendPosts->display();
		$FriendPosts->close();

		include "src/ForumPosts.php";
		$ForumPosts = new ForumPosts();
		$ForumPosts->display();
		$ForumPosts->close();
		*/
?>