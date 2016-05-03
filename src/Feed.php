

<?php

/**
*	@file : Feed.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Takes posts from database and displays them
*/

	session_start();

	if(isset($_GET['topic'])) {
		$_SESSION['topicname'] = $_GET['topic'];
	}

	class Feed {

		private $query;
		private $mysqli;
		private $user;
		private $topic;

		/**
		*  @name Feed
		*  @pre None
		*  @post Initializes variables and MySQL database
		*  @return none
		*/
		public function Feed() {
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');s

			$this->topic = $this->mysqli->real_escape_string($_SESSION["topicname"]);
			$this->query = "SELECT * FROM EECSPosts WHERE topic_id='$this->topic'";

			$this->user = $_SESSION["username"];
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


		/**
		*  @name display
		*  @pre None
		*  @post Displays posts and navigation
		*  @return none
		*/
		public function display() {
      	//Checks to make sure the mysql database can be accessed
      		$this->isOK();

			//echo "<h1>".$this->topic."</h1>";
			if ($result = $this->mysqli->query($this->query))
			{
				/* fetch associative array */

				//Here we display the posts with the related username, which also serves as a link to their profile page.
				echo "<ul>";
				while ($row = $result->fetch_assoc())
				{
					echo "<br>";
					printf ("%s \n", htmlspecialchars($row["content"]));
					echo "<br>-";
					printf ("<a href = 'ProfileFrontEnd.html?profile=%s'>%s</a> (%s)",
					htmlspecialchars($row["user_id"]),htmlspecialchars($row["user_id"]),htmlspecialchars($row["Date"]));
					echo "<br>";
				}
				echo "</ul>";

				/* free result set */
				$result->free();
			}

		}


	}
