<?php

/**
*	@file : ForumPosts.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Takes posts from user's Forums database and displays some
*/

	session_start();

	class ForumPosts {

		private $query;

		private $mysqli;

		private $user;
		private $forumList;



		/**
		*  @name FriendPosts()
		*  @pre None
		*  @post Initializes variables and MySQL database
		*  @return none
		*/

		public function ForumPosts() {
			$this->user = $_SESSION["username"];
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
			$this->getForums();

		}


		/**
		*  @name getForums()
		*  @pre user is logged in
		*  @post $forumList is set
		*  @return none
		*/
		public function getForums(){

			$this->query = "SELECT * FROM ". $_SESSION['profilename']."_Forums";
			$myForumList = array();

  		//Checks to make sure the mysql database can be accessed

    	$this->isOK();


			if ($result = $this->mysqli->query($this->query))
			{
			$i=0;

				// fetch associative array

				while ($row = $result->fetch_assoc())
				{
					$myForumList[$i] = $row["forum_id"];

					$i++;
				}

				// free result set

				$result->free();

			}
			$this->forumList =  $myForumList;

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


			$arrlength = count($this->friendList);

			for($x = 0; $x < $arrlength; $x++) {
				$forum = $this->forumList[$x];
				$this->query = "SELECT * FROM EECSPosts WHERE forum_id='$forum' AND isTopic=1";

				if ($result = $this->mysqli->query($this->query))
				{

					/* fetch associative array */

					$loopVal=0;

					//Here we display the posts with the related username, which also serves as a link to their profile page.

					echo "<ul>";

					while ($row = $result->fetch_assoc())

					{
						if($loopVal > 2)
						{
							break;
						}
						else
						{
							$loopVal++;
						}

						echo "<br>";

						printf ("<a href = 'FeedFrontEnd.html?topic=%s'>%s</a> \n", $row["topic_id"],$row["topic_id"]);

						echo "<br>-";

						printf ("<a href = 'ProfileFrontEnd.html?profile=%s'>%s</a> (%s)", $row["user_id"],$row["user_id"],$row["Date"]);

						echo "<br>";

					}

					echo "</ul>";



					/* free result set */

					$result->free();

				}
			}
		}


	}
