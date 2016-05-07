<?php
/**
*	@file : myRecentPosts.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Takes the user's posts from database and displays them
*/
	session_start();

	class MainFeedDriver {

		private $query;
		private $mysqli;
		private $user;
		private $userArray;
		private $friendList;
		//private $forumList;


		/**
		*  @name Feed
		*  @pre None
		*  @post Initializes variables and MySQL database
		*  @return none
		*/
		public function MainFeedDriver() {
			$this->user = $_SESSION["profilename"];
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
			$this->getFriends();
			$this->getForums();
			$this->getUserPosts();
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

		public function getFriends(){

			$this->query = "SELECT * FROM ". $_SESSION['profilename']."_Friends";

      		//Checks to make sure the mysql database can be accessed
      		$this->isOK();

			if ($result = $this->mysqli->query($this->query))
			{
				$i=0;

				// fetch associative array 
				while ($row = $result->fetch_assoc())
				{
					$this->friendList[$i] = $row["user_id"];
					$i++;
				}
				// free result set
				$result->free();
			}
		}
		

		public function getForums(){

			$this->query = "SELECT * FROM ". $_SESSION['profilename']."_Forums";

  			//Checks to make sure the mysql database can be accessed
    		$this->isOK();

			if ($result = $this->mysqli->query($this->query))
			{
				$i=0;

				// fetch associative array
				while ($row = $result->fetch_assoc())
				{
					$this->forumList[$i] = $row["forum_id"];
					$i++;
				}

				// free result set
				$result->free();
			}
		}
		
		public function getUserPosts(){
			$this->query = "SELECT * FROM EECSPosts WHERE user_id='$this->user'";
			
			$i = 0;
			$addString;			
			while($i < count($this->friendList))
			{
				$insertString = $this->friendList[$i];
				$addString = $addString. " OR user_id='$insertString'";
				$i++;
			}
			
			
			$i = 0;
			$addString;			
			while($i < count($this->forumList))
			{
				$insertString = $this->forumList[$i];
				$addString = $addString. " OR forum_id='$insertString'";
				$i++;
			}
			$this->query = $this->query . $addString;

  			//Checks to make sure the mysql database can be accessed
    		$this->isOK();

			if ($result = $this->mysqli->query($this->query))
			{
				$i = 0;
				
				// fetch associative array			
				while ($row = $result->fetch_assoc())
				{
					$this->userArray[$i] = $row;
					$i++;
				}

				// free result set
				$result->free();
			}
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
				//Here we display the posts with only the related date.
				if(is_null($this->userArray)) {
					echo "<ul>No posts to display</ul>";
				}
				
				else {
					echo "<ul>";
					$i = 0;
					$arrLength = count($this->userArray);
					// fetch associative array
				
					$reversed = array_reverse($this->userArray);
					while ($i < $arrLength )
					{
						printf ("<a href = 'FeedFrontEnd.html?topic=%s'>%s</a>", htmlspecialchars($reversed[$i]["topic_id"]), htmlspecialchars($reversed[$i]["topic_id"]));
						echo "<br>";
					
						printf ("%s \n", htmlspecialchars($reversed[$i]["content"]));
		
						echo "<br>";
						printf ("<a href = 'ProfileFrontEnd.html?profile=%s'>%s</a>", htmlspecialchars($reversed[$i]["user_id"]),htmlspecialchars($reversed[$i]["user_id"]));
						echo " - ";
						printf ("%s", htmlspecialchars($reversed[$i]["Date"]));
						echo "<br><br>";
						$i++;
					}
					echo "</ul>";
				}
				/* free result set */
				$result->free();
			}

		}
	}