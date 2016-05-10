<?php

/**
*	@file : TestSuite.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.05.04
*	@brief: Contains tests for sql
*/

session_start();
include "Create.php";
include "Forum.php";
include "Feed.php";
include "Follow.php";
include "Utility.php";
include "User.php";

class TestSuite {

	private $mysqli;
	private $user;
	private $create;
	private $topicpost;
	private $feedpost;
	private $topicName;
	private $forumName;

	/**
	*  @name TestSuite
	*  @pre None
	*  @post Initializes member variables
	*  @return none
	*/
	public function TestSuite() {
		$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
		$this->user = "TestAdmin";//"Admin";
		$this->topicpost = "Test Suite Topic Post";
		$this->feedpost = "Test Suite Feed Post";
		$this->topicName = "testTopic";
		$this->forumName = "Test";	
		
		if(isset($_SESSION['username'])) {
			$_SESSION['temp'] = $_SESSION['username'];
		}
		
		//Create a new test forum and user
		$this->mysqli->query("INSERT INTO EECSForums(forum_id) VALUES ('Test')");
		$this->mysqli->query("INSERT INTO EECSUsers(user_id) VALUES ('TestUser')");

	}
	/**
	 *  @name: RunTests
	 *  
	 *  @pre: None
	 *  @post: Runs the tests and displays whether they were successful
	 *  @return: None
	 */
	public function RunTests() {
		//This session variable is set so that Create.php knows to use these variables for posting.
		$_SESSION["TestSuite"] = true;

		echo "Create user: " . ($this->Test1() ? "Passed<br>" : "Failed<br>");
		echo "Create topic post: " . ($this->Test2() ? "Passed<br>" : "Failed<br>");
		echo "Display topic post: " . ($this->Test3() ? "Passed<br>" : "Failed<br>");
		echo "Create normal post: " . ($this->Test4() ? "Passed<br>" : "Failed<br>");
		echo "Display normal post: " . ($this->Test5() ? "Passed<br>" : "Failed<br>");
		echo "Delete post: " . ($this->Test6() ? "Passed<br>" : "Failed<br>");
		echo "checkUser on existing user: " . ($this->Test7() ? "Passed<br>" : "Failed<br>");
		echo "checkUser on nonexistent user: " . ($this->Test8() ? "Passed<br>" : "Failed<br>");
		echo "checkFriend on existing friend: " . ($this->Test9() ? "Passed<br>" : "Failed<br>");
		echo "checkFriend on nonexistent friend: " . ($this->Test10() ? "Passed<br>" : "Failed<br>");
		echo "checkForum on followed forum: " . ($this->Test11() ? "Passed<br>" : "Failed<br>");
		echo "checkForum on nonfollowed forum: " . ($this->Test12() ? "Passed<br>" : "Failed<br>");
		echo "checkBoard on existing forum: " . ($this->Test13() ? "Passed<br>" : "Failed<br>");
		echo "checkBoard on nonexistent forum: " . ($this->Test14() ? "Passed<br>" : "Failed<br>");
		echo "Adding a friend: " . ($this->Test15() ? "Passed<br>" : "Failed<br>");
		echo "Adding a followed forum: " . ($this->Test16() ? "Passed<br>" : "Failed<br>");
		echo "Removing a friend: " . ($this->Test17() ? "Passed<br>" : "Failed<br>");
		echo "Removing a followed forum: " . ($this->Test18() ? "Passed<br>" : "Failed<br>");
		echo "Delete user: " . ($this->Test20() ? "Passed<br>" : "Failed<br>");
		
		//The session variable is set to false so that Create.php knows not to use these variables.
		$_SESSION["TestSuite"] = false;
		//Delete the test forum/posts/user
		$this->mysqli->query("DELETE FROM EECSUsers WHERE user_id = 'TestUser'");
		$this->mysqli->query("DELETE FROM EECSPosts WHERE forum_id = 'Test'");
		$this->mysqli->query("DELETE FROM EECSForums WHERE forum_id = 'Test'");
		
		if(isset($_SESSION['temp'])) {
			$_SESSION['username'] = $_SESSION['temp'];
			unset($_SESSION['temp']);
		}
	}

	/**
	*  @name isOK
	*  @pre None
	*  @post Prints error if connection failed
	*  @return none
	*/
	private function isOK() {
		if ($this->mysqli->connect_errno) {
			printf("Connect failed: %s\n", $this->mysqli->connect_error);
			exit();
		}
	}
	/**
	 *  @name: close
	 *  
	 *  @pre: Connected to database
	 *  @post: Closes the connection
	 *  @return: None
	 */
	public function close() {
		$this->mysqli->close();
	}
	/**
	 *  @name: Test1
	 *  @brief: Tests user creation
	 *  @pre: None
	 *  @post: Prints whether a user has been created or not
	 *  @return: True if a user has been created, false if not.
	 */
	private function Test1(){
		$_SESSION['TestUsername'] = "TestAdmin";
		$_SESSION['TestPassword'] = "TestPassword";
		
		$user = new User();
		$value = $user->signup();
		$user->close();
		return($value==1);
		
	}
	/**
	 *  @name: Test2
	 *  @brief: Tests topic post creation
	 *  @pre: None
	 *  @post: Displays whether a topic post has been created
	 *  @return: True if a topic post was created, false if not
	 */
	private function Test2(){
	
		$_SESSION["testmypost"] = $this->topicpost;
		$_SESSION["username"] = $this->user;
		$_SESSION["forumname"] = $this->forumName;
		$_SESSION["testtopicID"] = $this->topicName;
		$_SESSION["testisForum"] = 0;
		$_SESSION["testisTopic"] = 1;

		try{
			$this->create = new Create();
			if($this->create->makePost()){
				return true;
			}
			else {
				return false;
			}
		}
		catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	}
	/**
	 *  @name: Test3
	 *  @brief: Tests displaying topics
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the topic was displayed, false otherwise
	 */
	private function Test3(){
		$forum = new Forum();
		$value = $forum->display();
		$forum->close();
		return($value);
	}
	/**
	 *  @name: Test4
	 *  @brief: Tests creating normal posts
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the post was created, false otherwise.
	 */
	private function Test4(){
	
		$_SESSION["testmypost"] = $this->feedpost;
		$_SESSION["username"] = $this->user;
		$_SESSION["forumname"] = $this->forumName;
		$_SESSION["testtopicID"] = $this->topicName;
		$_SESSION["testisForum"] = 0;
		$_SESSION["testisTopic"] = 0;

		try{
			$this->create = new Create();
			if($this->create->makePost()){
				return true;
			}
			else {
				return false;
			}
		}
		catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	/**
	 *  @name: Test5
	 *  @brief: Test displaying normal posts
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the post was displayed, false otherwise
	 */
	private function Test5(){
		$_SESSION["topicname"] = "testTopic";
		$feed = new Feed();
		$value = $feed->display();
		$feed->close();
		return($value);
	}
	/**
	 *  @name: Test6
	 *  @brief: Tests deletePost when the post exists
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the post was deleted, false otherwise
	 */
	private function Test6(){
		$create = new Create();
		$result = $this->mysqli->query("SELECT post_id FROM EECSPosts WHERE content = 'Test Suite Feed Post'");
		$row = $result->fetch_assoc();
		
		return($create->deletePost($row['post_id']));
	}
	/**
	 *  @name: Test7
	 *  @brief: Tests checkUser when the user exists
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test7(){
		$util = new Utility();
		return($util->checkUser("TestAdmin"));
		
	}

	 /**
	  *  @name: Test8
	  *  @brief: Tests checkUser when the user does not exist
	  *  @pre: None
	  *  @post: None
	  *  @return: True if the test is passed, false if not
	  */
	private function Test8(){
		$util = new Utility();
		$user = "usernames_can_only_have_25_characters";
		return(!($util->checkUser($user)));
	}
	 /**
	  *  @name: Test9
	  *  @brief: Tests checkFriend when the friend exists
	  *  @pre: None
	  *  @post: None
	  *  @return: True if the test is passed, false if not
	  */
	private function Test9(){
		$util = new Utility();
		
		$this->mysqli->query("INSERT INTO TestAdmin_Friends(user_id) VALUES ('TestUser')");
		
		$value = $util->checkFriend("TestAdmin", "TestUser");
		$this->mysqli->query("DELETE FROM TestAdmin_Friends WHERE user_id = 'TestUser'");
		
		$util->close();		
		return($value);
	}
	/**
	 *  @name: Test10
	 *  @brief: Tests checkFriend when the friend does not exist
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test10(){
		$util = new Utility();
		
		$value = ! ($util->checkFriend("TestAdmin", "TestUser"));
		$util->close();
		return($value);

	}
	/**
	 *  @name: Test11
	 *  @brief: Tests checkForum when the forum exists
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test11(){
		$util = new Utility();
			
		$this->mysqli->query("INSERT INTO TestAdmin_Forums(forum_id) VALUES ('Test')");
		$value = $util->checkForum("TestAdmin", "Test");
		$this->mysqli->query("DELETE FROM TestAdmin_Forums WHERE forum_id = 'Test'");
		
		$util->close();
		
		return($value);

	}
	/**
	 *  @name: Test12
	 *  @brief: Tests checkForum when the forum does not exist
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test12(){
		$util = new Utility();
		
		$value = ! ($util->checkForum("TestAdmin", "TestForum"));
		$util->close();
		return($value);

	}
	/**
	 *  @name: Test13
	 *  @brief: Tests checkBoard when the board exists
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test13(){
		$util = new Utility();
		
		$value = $util->checkBoard("Test");
		$util->close();
		return($value);
	}
	/**
	 *  @name: Test15
	 *  @brief: Tests checkBoard when the board does not exist
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test14(){
		$util = new Utility();
		
		$value = !($util->checkBoard("thisforumdoesnotexist"));
		$util->close();
		return($value);
		
	}
	 /**
	  *  @name: Test15
	  *  @brief: Tests adding a friend
	  *  @pre: None
	  *  @post: None
	  *  @return: True if the friend was added, false otherwise
	  */
	private function Test15(){
		$follow = new Follow();
		$value = $follow->addFriend("TestAdmin", "TestUser");
		$follow->close();
		return($value);
	}
	 /**
	  *  @name: Test20
	  *  @brief: Tests adding a followed forum
	  *  @pre: None
	  *  @post: None
	  *  @return: True if the forum was followed, false otherwise
	  */
	private function Test16(){
		$follow = new Follow();
		$value = $follow->addForum("TestAdmin", "Test");
		$follow->close();
		return($value);
	}
	/**
	 *  @name: Test20
	 *  @brief: Tests deleting users
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the user was deleted, false otherwise
	*/
	private function Test17(){
		$follow = new Follow();
		$value = $follow->removeFriend("TestAdmin", "TestUser");
		$follow->close();
		return($value);
	}
	
	/**
	 *  @name: Test20
	 *  @brief: Tests deleting friends
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the user was deleted, false otherwise
	 */
	private function Test18(){
		$follow = new Follow();
		$value = $follow->removeForum("TestAdmin", "Test");
		$follow->close();
		return($value);
	}
	/**
	 *  @name: Test20
	 *  @brief: Tests deleting users
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the user was deleted, false otherwise
	 */
	private function Test20(){
		$user = new User();
		$value = $user->deleteUser("TestAdmin");
		$user->close();
		return($value);
	}

	
	
}

?>
