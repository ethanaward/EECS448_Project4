/**
*	@file : Feed.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Takes posts from database and displays them
*/

<?php

	session_start();

	class Feed {

		private $query;
		private $mysqli;
		private $user;

		public function Feed() {
			$this->query = "SELECT * FROM EECSPosts";
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
			$this->user = $_POST["user"];
		}

		private function isOK() {
			if ($this->mysqli->connect_errno) {
				printf("Connect failed: %s\n", $this->mysqli->connect_error);
				exit();
			}
		}

		public function display() {
      //Checks to make sure the mysql database can be accessed
      $this->isOK();

			echo "<h1>Main Feed</h1>";
			if ($result = $this->mysqli->query($this->query))
			{
				/* fetch associative array */

				//Here we display the posts with the related username, which also serves as a link to their profile page.
				echo "<ul>";
				while ($row = $result->fetch_assoc())
				{
					echo "<br>";
					printf ("%s \n", $row["content"]);
					echo "<br>-";
					printf ("<a href = 'ProfileFrontEnd.html?profile=%s'>%s</a> \n", $row["user_id"],$row["user_id"]);
					echo "<br>";
				}
				echo "</ul>";

				/* free result set */
				$result->free();
			}

			/* close connection */
			$this->mysqli->close();

		}


	}
