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

class TestSuite {

	private $mysqli;
	private $user;
	private $create;
	private $topicpost;
	private $feedpost;
	private $topicName;
	private $forumName;

	/**
	*  @name runTests
	*  @pre None
	*  @post runs the other test functions
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

	public function RunTests() {
		//This session variable is set so that Create.php knows to use these variables for posting.
		$_SESSION["TestSuite"] = true;

		$this->CreateUserTest();
		$this->TopicPostTest();
		$this->DisplayTopicPostTest();
		$this->FeedPostTest();
		$this->DisplayFeedPostTest();
		$this->DeletePostTest();
		$this->DeleteUserTest();

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

	public function close() {
		$this->mysqli->close();
	}
	private function CreateUserTest(){
		//create a user called "Admin"
	}
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
				echo "<p>Topic post created successfully.</p>";
			}
			else {
				echo "<p>Topic post creation failed.</p>";
			}
		}
		catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}

	}
	private function DisplayTopicPostTest(){
		$forum = new Forum();
		$forum->display();
		$forum->close();
	}
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
				echo "<p>Feed post created successfully.</p>";
			}
			else {
				echo "<p>Feed post creation failed.</p>";
			}
		}
		catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		//search EECSPosts for this post
		//if found, $result = true
	}
	private function DisplayFeedPostTest(){
		$_SESSION["topicname"] = "testTopic";
		$feed = new Feed();
		$feed->display();
		$feed->close();
	}
	private function DeletePostTest(){

	}
	private function DeleteUserTest(){

	}
	private function OtherTests(){

	}
}

?>
