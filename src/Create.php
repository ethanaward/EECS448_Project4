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
		private $forum;
		private $topic;
		private $isForum;
		private $isTopic;
		private $Date;
		private $here;
		private $query;
		private $mysqli;
		private $exists;

		/**
		*  @name Create
		*  @pre HTML form for post submitted
		*  @post Intitializes variables and MySQL database
		*  @return none
		*/
		public function Create()
		{

			//Here we initialize the connection to the database.
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
			//These two variables hold the post content and the username of the poster respectively.
			$this->post = $_POST["mypost"];
			$this->user = $_SESSION["username"];
			$this->forum = $_SESSION["forumname"];
			$this->isForum = $_POST["isForum"];
			$this->isTopic = $_POST["isTopic"];
			$this->Date = $_POST["Date"];

			if( isset($_POST['topicID']) )
			{
				$this->topic = $_POST['topicID'];
				$_SESSION["topicname"] = $this->topic;
				$this->topic = $this->mysqli->real_escape_string($this->topic);
			}
			else
			{
				$this->topic = $_SESSION["topicname"];
			}

			//This query is used to see if the topic already exists in this forum.
			$exists = "SELECT topic_id FROM EECSPosts WHERE forum_id='$this->forum'";

			//Here I escape the post return into a correctly formatted string.
			//Example: without this line, if the post contains a single apostrophe ("I'm coding."),
			//Then that apostrophe will confuse the query and the program crashes.
			$this->post = $this->mysqli->real_escape_string($this->post);


			//This query we will use to add the post with the username into the EECSPosts database.
			$this->query = "INSERT INTO EECSPosts (content, user_id, forum_id, topic_id, isForum, isTopic, Date) VALUES('$this->post', '$this->user', '$this->forum', '$this->topic', '$this->isForum', '$this->isTopic', '$this->Date' )";

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

		public function close() {
			
			$this->mysqli->close();
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
					//echo "New post created successfully!";
					if($_GET['topic'] == 0) {
  						header("Location: ForumFrontEnd.html", TRUE, 303);
					}
					else {
  						header("Location: FeedFrontEnd.html", TRUE, 303);
					}
			} else {
					echo "Error: ".$this->query."<br>".$this->mysqli->error;
			}

		}
		/**
		*  @name topicExists
		*  @pre HTML form for post submitted, database initialized
		*  @post none
		*  @return True if the new topic had already been created
		*/
		public function topicExists(){
			$topic = $this->topic;
			$id = "";
			if($result = $this->mysqli->query($this->exists)) {

			    // fetch associative array
			    while ($row = $result->fetch_assoc()) {
					$id = $row["topic_id"];
					if(strcmp($topic, $id)==0){
						return true;
					}
			    }

			    // free result set
			    $result->free();
			}
			return false;
		}

		public function deletePost($post_id) {
			$this->isOK();

			$this->query = "DELETE FROM EECSPosts WHERE post_id = '".$post_id."'";

			if($this->mysqli->query($this->query)) {
				return true;
			}
			else {
				return false;
			}
		}
	}
?>
