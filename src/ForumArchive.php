<?php


/**
*	@file : ForumArchive.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Takes forums from user's forum database and displays them
*/

	session_start();

	class ForumArchive {

		private $query;
		private $mysqli;
		private $user;

		/**
		*  @name ForumArchive
		*  @pre None
		*  @post Initializes variables and MySQL database
		*  @return none
		*/

		public function ForumArchive() {
			$this->user = $_SESSION["username"];

			$this->query = "SELECT * FROM EECSForums";

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

			if ($result = $this->mysqli->query($this->query))

			{
				/* fetch associative array */

				//Here we display the archives, with a link to the forum page.
				echo "<ul>";
				while ($row = $result->fetch_assoc())
				{
					printf ("<a href = 'ForumFrontEnd.html?forum=%s'>%s</a> \n", $row["forum_id"],$row["forum_id"]);
					echo "<br>";
				}
				echo "</ul>";

				/* free result set */

				$result->free();

			}

		}


	}
