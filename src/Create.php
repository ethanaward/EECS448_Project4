<?php
/**
*	@file : Create.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new post in MySQL database
*/
session_start();

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
		*  @name: Create
		*  @name: Create
		*  @pre: HTML form for post submitted
		*  @post: Intitializes variables and MySQL database
		*  @return: none
		*/
		public function Create()
		{

			//Here we initialize the connection to the database.
			
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
			
			//These variables hold the data received from the post array, sanitized for use in a mysql database
			$this->post = $this->mysqli->real_escape_string($_POST["mypost"]);
			$this->user = $this->mysqli->real_escape_string($_SESSION["username"]);
			$this->forum = $this->mysqli->real_escape_string($_SESSION["forumname"]);
			$this->isForum = $this->mysqli->real_escape_string($_POST["isForum"]);
			$this->isTopic = $this->mysqli->real_escape_string($_POST["isTopic"]);
			$this->Date = $this->mysqli->real_escape_string($_POST["Date"]);

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

			
			if( isset($_SESSION["TestSuite"]) )
			{
				if($_SESSION["TestSuite"])
				{
					$this->post = $_SESSION["testmypost"];
					$this->user = $_SESSION["username"];
					$this->forum = $_SESSION["forumname"];
					$this->topic = $_SESSION["testtopicID"];
					$this->isForum = $_SESSION["testisForum"];
					$this->isTopic = $_SESSION["testisTopic"];
				}
			}

			//This query is used to see if the topic already exists in this forum.
			$this->exists = "SELECT topic_id FROM EECSPosts WHERE forum_id='$this->forum'";

			//This query we will use to add the post with the username into the EECSPosts database.
			$this->query = "INSERT INTO EECSPosts (content, user_id, forum_id, topic_id, isForum, isTopic, Date) VALUES('$this->post', '$this->user', '$this->forum', '$this->topic', '$this->isForum', '$this->isTopic', '$this->Date' )";

		}
		/**
		*  @name: isOK
		*  @pre: None
		*  @post: Prints error if connection failed
		*  @return: none
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
		 *  @name: redirectPage 
		 *  
		 *  @pre: None
		 *  @post: Redirects the user to the appropriate page
		 *  @return: None
		 */
		public function redirectPage() {
				if($_GET['topic'] == 0) {
  					header("Location: ForumFrontEnd.html", TRUE, 303);
				}
				else {
  					header("Location: FeedFrontEnd.html", TRUE, 303);
				}
		}
		/**
		*  @name: makePost
		*  @pre: HTML form for post submitted, database initialized
		*  @post: Inserts a post into the database
		*  @return: True if the post is made, false otherwise
		*/
		public function makePost()
		{
			//Test to make sure the database can be accessed
			$this->isOK();
			
			if($this->mysqli->query($this->query)) {
					return true;

			} else {
				echo "Error: " . $this->query . "<br>" . $this->mysqli->error;
					return false;
			}

		}
		/**
		*  @name: topicExists
		*  @pre: HTML form for post submitted, database initialized
		*  @post: none
		*  @return: True if the topic exists, false otherwise
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
			else {
				echo "Error: " . $this->query . "<br>" . $this->mysqli->error;
				return false;
			}
		}
		/**
		 *  @name: deletePost
		 *  
		 *  @pre: Connected to database, post exists
		 *  @post: The taken in post is deleted
		 *  @param [in] $post_id : The id of the post to be deleted
		 *  @return: True if the post is deleted, false otherwise.
		 */
		public function deletePost($post_id) {
			$this->isOK();

			$this->query = "DELETE FROM EECSPosts WHERE post_id = '".$post_id."'";
			$this->mysqli->query($this->query);
			if($mysqli->affected_rows == 1) {
				return true;
			}
			else {
				return false;
			}
		}
	}
?>
