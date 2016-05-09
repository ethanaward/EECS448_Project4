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
		$this->user = "mike";//"Admin";
		$this->topicpost = "Test Suite Topic Post";
		$this->feedpost = "Test Suite Feed Post";
		$this->topicName = "testTopic";
		$this->forumName = "EECS448";	

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

		echo "Create user test passed: " . ($this->CreateUserTest() ? "True<br>" : "False<br>");
		echo "Create topic post test passed: " . ($this->TopicPostTest() ? "True<br>" : "False<br>");
		echo "Display topic post test passed: " . ($this->DisplayTopicPostTest() ? "True<br>" : "False<br>");
		echo "Create normal post test passed: " . ($this->FeedPostTest() ? "True<br>" : "False<br>");
		echo "Display normal post test passed: " . ($this->DisplayFeedPostTest() ? "True<br>" : "False<br>");
		echo "Delete post test passed: " . ($this->DeletePostTest() ? "True<br>" : "False<br>");
		echo "Delete user post test passed: " . ($this->DeleteUserTest() ? "True<br>" : "False<br>");

		//The session variable is set to false so that Create.php knows not to use these variables.
		$_SESSION["TestSuite"] = false;
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
	 *  @name: CreateUserTest
	 *  
	 *  @pre: None
	 *  @post: Prints whether a user has been created or not
	 *  @return: True if a user has been created, false if not.
	 */
	private function CreateUserTest(){
		//create a user called "Admin"
	}
	/**
	 *  @name: TopicPostTest
	 *  
	 *  @pre: None
	 *  @post: Displays whether a topic post has been created
	 *  @return: True if a topic post was created, false if not
	 */
	private function TopicPostTest(){
	
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
	 *  @name: DisplayTopicPostTest
	 *  
	 *  @pre: None
	 *  @post: None
	 *  @return: True if the topic was displayed, false otherwise
	 */
	private function DisplayTopicPostTest(){
		$forum = new Forum();
		$value = $forum->display();
		$forum->close();
		return($value);
	}
	/**
	 *  @name: 
	 *  
	 *  @pre: 
	 *  @post: 
	 *  @return: 
	 */
	private function FeedPostTest(){
	
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
	 *  @name: 
	 *  
	 *  @pre: 
	 *  @post: 
	 *  @return: 
	 */
	private function DisplayFeedPostTest(){
		$_SESSION["topicname"] = "testTopic";
		$feed = new Feed();
		$value = $feed->display();
		$feed->close();
		return($value);
	}
	/**
	 *  @name: 
	 *  
	 *  @pre: 
	 *  @post: 
	 *  @return: 
	 */
	private function DeletePostTest(){

	}
	/**
	 *  @name: 
	 *  
	 *  @pre: 
	 *  @post: 
	 *  @return: 
	 */
	private function DeleteUserTest(){

	}
	/**
	 *  @name: 
	 *  
	 *  @pre: 
	 *  @post: 
	 *  @return: 
	 */
	private function OtherTests(){

	}
}

?>
