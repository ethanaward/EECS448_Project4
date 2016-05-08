<?php
/**
*	@file : Edit.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Updates database with edited profile information
*/
session_start();
	class Edit {

		private $mysqli;
		private $firstname;
		private $lastname;
		private $email;
		private $description;
		private $website;
		private $query;

		/**
		*  @name Edit
		*  @pre HTML edit form submitted
		*  @post Intitializes variables and MySQL database
		*  @return none
		*/
		public function Edit()
		{
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

			$this->email = $this->mysqli->real_escape_string($_POST['email']);
			$this->firstname = $this->mysqli->real_escape_string($_POST['firstName']);
			$this->lastname = $this->mysqli->real_escape_string($_POST['lastName']);
			$this->description = $this->mysqli->real_escape_string($_POST['description']);
			$this->website = $this->mysqli->real_escape_string($_POST['website']);
			
			$this->query = "UPDATE EECSUsers SET Email='$this->email', FirstName='$this->firstname', LastName='$this->lastname', Description='$this->description', Website='$this->website'
			 										WHERE user_id='".$_SESSION['username']."'";
		}

		/**
		*  @name isOK
		*  @pre None
		*  @post Prints error if connection failed
		*  @return none
		*/
		private function isOK()
		{
			if($this->mysqli->connect_errno)
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
		*  @name redirectPage
		*  @pre None
		*  @post The user is redirected to the profile page
		*  @return none
		*/
		public function redirectPage()
		{
			header("Location: ProfileFrontEnd.html", TRUE, 303);
		}

		/**
		*  @name editProfile
		*  @pre Connected to database
		*  @post Profile page and database are updated with new data
		*  @return True if the values are updated, false otherwise
		*/
		public function editProfile()
		{
			$this->isOK();

			if($this->mysqli->query($this->query))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

	}
?>
