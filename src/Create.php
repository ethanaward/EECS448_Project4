

<?php

/**
*	@file : Create.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new post in MySQL database
*/
session_start();
/*
* Author: Michael Neises
* Date Modified: April 8, 2016
* Purpose: to add a post to the EECSPosts database
*/
	class Create
	{

		private $post;
		private $user;
		private $here;
		private $query;
		private $mysqli;


		/**
		*  @name Create
		*  @pre HTML form for post submitted
		*  @post Intitializes variables and MySQL database
		*  @return none
		*/
		public function Create()
		{

			//These two variables hold the post content and the username of the poster respectively.
			$this->post = $_POST["mypost"];
			$this->user = $_SESSION["username"];
			$this->forum = $_SESSION["forumname"];
			$this->topic = $_SESSION["topicname"];
			$this->isForum = $_POST["isForum"];
			$this->isTopic = $_POST["isTopic"];

			//This variable is used to see if the user_id exists within the EECSUsers database.
			$this->here = false;

			//Here we initialize the connection to the database.
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');


			//Here I escape the post return into a correctly formatted string.
			//Example: without this line, if the post contains a single apostrophe ("I'm coding."),
			//Then that apostrophe will confuse the query and the program crashes.
			$this->post = $this->mysqli->real_escape_string($this->post);


			//This query we will use to add the post with the username into the EECSPosts database.
			$this->query = "INSERT INTO EECSPosts (content, user_id, forum_id, topic_id, isForum, isTopic) VALUES('$this->post', '$this->user', '$this->forum', '$this->topic', '$this->isForum', '$this->isTopic')";

		}

		/**
		*  @name isOK
		*  @pre None
		*  @post Prints error if connection failed
		*  @return none
		*/
		private function isOK()
		{
			/* check connection */
			if ($this->mysqli->connect_errno)
			{
				printf("Connect failed: %s\n", $this->mysqli->connect_error);
				exit();
			}
		}

		/**
		*  @name makePost
		*  @pre HTML form for post submitted, database initialized
		*  @post Alters MySQL database
		*  @return none
		*/
		public function makePost()
		{
			//Test to make sure the database can be accessed
			$this->isOK();

			//See echos for explanations inside this conditional.
			if($this->mysqli->query($this->query)==TRUE) {
					echo "New post created successfully!";
			} else {
					echo "Error: ".$this->query."<br>".$this->mysqli->error;
			}

			//close connection
			$this->mysqli->close();


		}

	}
?>
