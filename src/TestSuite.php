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
		//Create a new test forum
		$this->mysqli->query("INSERT INTO EECSForums(forum_id) VALUES ('Test')");

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
		echo "Delete nonexistent post: " . ($this->Test7() ? "Passed<br>" : "Failed<br>");
		echo "checkUser on existing user: " . ($this->Test8() ? "Passed<br>" : "Failed<br>");
		echo "checkUser on nonexistent user: " . ($this->Test9() ? "Passed<br>" : "Failed<br>");
		echo "checkFriend on existing user: " . ($this->Test10() ? "Passed<br>" : "Failed<br>");
		echo "checkFriend on nonexistent user: " . ($this->Test11() ? "Passed<br>" : "Failed<br>");
		echo "checkForum on existing user: " . ($this->Test12() ? "Passed<br>" : "Failed<br>");
		echo "checkForum on nonexistent user: " . ($this->Test13() ? "Passed<br>" : "Failed<br>");
		echo "checkBoard on existing user: " . ($this->Test14() ? "Passed<br>" : "Failed<br>");
		echo "checkBoard on nonexistent user: " . ($this->Test15() ? "Passed<br>" : "Failed<br>");
		echo "Delete user: " . ($this->Test16() ? "Passed<br>" : "Failed<br>");
		

		//The session variable is set to false so that Create.php knows not to use these variables.
		$_SESSION["TestSuite"] = false;
		//Delete the test forum/posts
		$this->mysqli->query("DELETE FROM EECSPosts WHERE forum_id = 'Test'");
		$this->mysqli->query("DELETE FROM EECSForums WHERE forum_id = 'Test'");
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
		
		$user = new User();
		$value = $user->signup();
		$user->close();
		return($value);
		
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
		//search EECSPosts for this post
		//if found, $result = true
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
	 *  @brief: Tests deletePost when the post does not exist
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test7(){
		$create = new Create();
		$result = $this->mysqli->query("SELECT post_id FROM EECSPosts ORDER BY post_id DESC LIMIT 1");
		$row = $result->fetch_assoc();
		$id = $row['post_id'];
		$id++;
		return(!($create->deletePost($id)));
	}
	/**
	 *  @name: Test8
	 *  @brief: Tests checkUser when the user exists
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test8(){
		$util = new Utility();
		$user = "mike";
		return($util->checkUser($user));
		
	}

	 /**
	  *  @name: Test9
	  *  @brief: Tests checkUser when the user does not exist
	  *  @pre: None
	  *  @post: None
	  *  @return: True if the test is passed, false if not
	  */
	private function Test9(){
		$util = new Utility();
		$user = "thisuserdoesnotexist";
		return(!($util->checkUser($user)));
	}
	 /**
	  *  @name: Test10
	  *  @brief: Tests checkFriend when the friend exists
	  *  @pre: None
	  *  @post: None
	  *  @return: True if the test is passed, false if not
	  */
	private function Test10(){
		$follow = new Follow();
		$util = new Utility();
		
		$this->mysqli->query("INSERT INTO EECSUsers(user_id) VALUES ('TestUser')");
		$follow->addFriend("TestAdmin", "TestUser");
		
		$value = $util->checkFriend("TestAdmin", "TestUser");
		$follow->removeFriend("TestAdmin", "TestUser");
		
		$util->close();
		$follow->close();
		
		return($value);
	}
	/**
	 *  @name: Test11
	 *  @brief: Tests checkFriend when the friend does not exist
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test11(){
		$util = new Utility();
		
		$value = ! ($util->checkFriend("TestAdmin", "TestUser"));
		$util->close();
		return($value);

	}
	/**
	 *  @name: Test12
	 *  @brief: Tests checkForum when the forum exists
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test12(){
		$follow = new Follow();
		$util = new Utility();
	
		$follow->addForum("TestAdmin", "TestForum");
		
		$value = $util->checkForum("TestAdmin", "TestForum");
		$follow->removeForum("TestAdmin", "TestForum");
		
		$util->close();
		$follow->close();
		
		return($value);

	}
	/**
	 *  @name: Test13
	 *  @brief: Tests checkForum when the forum does not exist
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test13(){
		$util = new Utility();
		
		$value = ! ($util->checkForum("TestAdmin", "TestForum"));
		$util->close();
		return($value);

	}
	/**
	 *  @name: Test14
	 *  @brief: Tests checkBoard when the board exists
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the test is passed, false if not
	 */
	private function Test14(){
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
	private function Test15(){
		$util = new Utility();
		
		$value = !($util->checkBoard("thisforumdoesnotexist"));
		$util->close();
		return($value);
		
	}
	/**
	 *  @name: Test16
	 *  @brief: Tests deleting users
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the user was deleted, false otherwise
	 */
	private function Test16(){
		
	}

	
	
}

?>
