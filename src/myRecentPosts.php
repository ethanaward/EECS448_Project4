

<?php

/**
*	@file : myRecentPosts.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Takes the user's posts from database and displays them
*/

	session_start();

	class myRecentPosts {

		private $query;
		private $mysqli;
		private $user;

		/**
		*  @name Feed
		*  @pre None
		*  @post Initializes variables and MySQL database
		*  @return none
		*/
		public function myRecentPosts() {
			$this->user = $_SESSION["profilename"];
			$this->query = "SELECT * FROM EECSPosts WHERE user_id='$this->user'";
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
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

				//Here we display the posts with only the related date.
				echo "<ul>";
				while ($row = $result->fetch_assoc())
				{
					echo "<br>";
					printf ("%s \n", $row["content"]);
					echo "<br>-";
					printf ("%s", $row["Date"]);
					echo "<br>";
				}
				echo "</ul>";

				/* free result set */
				$result->free();
			}

		}


	}
