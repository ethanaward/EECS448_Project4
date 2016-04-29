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
		private $query;

		/**
		*  @name display
		*  @pre HTML edit form submitted
		*  @post Intitializes variables and MySQL database
		*  @return none
		*/
		public function Edit()
		{
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

			$this->email = $_POST['email'];
			$this->firstname = $_POST['firstName'];
			$this->lastname = $_POST['lastName'];

			$this->query = "UPDATE EECSUsers SET Email='$this->email', FirstName='$this->firstname', LastName='$this->lastname' WHERE user_id='".$_SESSION['username']."'";
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
		*  @name redirectPage
		*  @pre None
		*  @post The user is redirected to the profile page
		*  @return none
		*/
		private function redirectPage()
		{
			header("Location: ProfileFrontEnd.html", TRUE, 303);
		}

		/**
		*  @name editProfile
		*  @pre MySQL initialized
		*  @post Profile page and database are updated with new data
		*  @return none
		*/
		public function editProfile()
		{

			$this->isOK();

			if($this->mysqli->query($this->query))
			{

			}
			else
			{
				echo "Error: <br>" . $this->mysqli->error;
			}

			$this->mysqli->close();

			$this->redirectPage();

		}

	}
?>
