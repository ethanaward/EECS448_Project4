<?php

/**
*	@file : TestSuite.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.05.04
*	@brief: Contains tests for sql
*/

session_start();
include "Create.php";

class TestSuite {

	private $mysqli;
	private $user;
	private $create;

	private $post;
	private $topicName;
	private $forumName;

	/**
	*  @name runTests
	*  @pre None
	*  @post runs the other test functions
	*  @return none
	*/
	public function runTests() {
		$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
		$this->user = "Admin";
		$this->create = new Create();	

		$this->post = "testpost";
		$this->topicName = "testTopic";
		$this->forumName = "EECS448";	

		CreateUserTest();
		TopicPostTest();
		FeedPostTest();
		DeletePostTest();
		DeleteUserTest();
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
		$result = false;
	
		$_POST["mypost"] = $this->post;
		$_SESSION["username"] = $this->user;
		$_SESSION["forumname"] = $this->forumName;
		$_POST['topicID'] = $this->topicName;
		$_POST["isForum"] = 0;
		$_POST["isTopic"] = 1;

		$create->makePost();

		//search EECSPosts for this post
		//if found, $result = true
		if($result)
		{
			echo "Topic post created successfully.";
		}
		else
		{
			echo "Topic post creation failed.";
		}
	}
	private function FeedPostTest(){
		$result = false;
	
		$_POST["mypost"] = $this->post;
		$_SESSION["username"] = $this->user;
		$_SESSION["forumname"] = $this->forumName;
		$_POST['topicID'] = $this->topicName;
		$_POST["isForum"] = 0;
		$_POST["isTopic"] = 0;

		$create->makePost();

		//search EECSPosts for this post
		//if found, $result = true
		if($result)
		{
			echo "Feed post created successfully.";
		}
		else
		{
			echo "Feed post creation failed.";
		}
	}
	private function DeletePostTest(){

	}
	private function DeleteUserTest(){

	}
	private function OtherTests(){

	}
}

?>
