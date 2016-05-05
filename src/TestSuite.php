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
	public function TestSuite() {
		$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
		$this->user = "mike";//"Admin";
		$this->create = new Create();	

		$this->post = "testpost";
		$this->topicName = "testTopic";
		$this->forumName = "EECS448";	

	}

	public function RunTests() {
		$_SESSION["TestSuite"] = true;

		$this->CreateUserTest();
		$this->TopicPostTest();
		$this->FeedPostTest();
		$this->DeletePostTest();
		$this->DeleteUserTest();

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
		$result = false;
	
		$_SESSION["testmypost"] = $this->post;
		$_SESSION["username"] = $this->user;
		$_SESSION["forumname"] = $this->forumName;
		$_SESSION["testtopicID"] = $this->topicName;
		$_SESSION["testisForum"] = 0;
		$_SESSION["testisTopic"] = 1;

		try{
			$this->create->makePost();
		}
		catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		//search EECSPosts for this post
		//if found, $result = true
		if($result)
		{
			echo "<p>Topic post created successfully.</p>";
		}
		else
		{
			echo "<p>Topic post creation failed.</p>";
		}
	}
	private function FeedPostTest(){
		$result = false;
	
		$_SESSION["testmypost"] = $this->post;
		$_SESSION["username"] = $this->user;
		$_SESSION["forumname"] = $this->forumName;
		$_SESSION["testtopicID"] = $this->topicName;
		$_SESSION["testisForum"] = 0;
		$_SESSION["testisTopic"] = 0;

		try{
			$this->create->makePost();
		}
		catch(Exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		//search EECSPosts for this post
		//if found, $result = true
		if($result)
		{
			echo "<p>Feed post created successfully.</p>";
		}
		else
		{
			echo "<p>Feed post creation failed.</p>";
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
