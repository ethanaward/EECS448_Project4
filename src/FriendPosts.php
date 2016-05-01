



<?php



/**

*	@file : FriendPosts.php

*	@author : Mike Neises, Travis Augustine, Ethan Ward

*	@date : 2016.04.08

*	@brief: Takes posts from friends' databases and displays them

*/



	session_start();





	class FriendPosts {



		private $query;

		private $mysqli;

		private $user;
		private $friendList;



		/**

		*  @name FriendPosts()

		*  @pre None

		*  @post Initializes variables and MySQL database

		*  @return none

		*/

		public function FriendPosts() {
			$this->user = $_SESSION["username"];

			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
			$this->getFriends();

		}


		/**

		*  @name getFriends()

		*  @pre user is logged in

		*  @post $friendList is set

		*  @return none

		*/
		public function getFriends(){

			$this->query = "SELECT * FROM ". $_SESSION['profilename']."_Friends";
			$myFriendList = array();			

      		//Checks to make sure the mysql database can be accessed

      		$this->isOK();


			if ($result = $this->mysqli->query($this->query))

			{
			$i=0;

				// fetch associative array 

				while ($row = $result->fetch_assoc())

				{
					$myFriendList[$i] = $row["user_id"];

					$i++;
				}

				// free result set

				$result->free();

			}
			$this->friendList =  $myFriendList;

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
				$friend = $this->friendList[$x];
				$this->query = "SELECT * FROM EECSPosts WHERE user_id='$friend'";

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

						printf ("%s \n", $row["content"]);

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
