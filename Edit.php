<?php

session_start();

	class Edit {
		
		private $mysqli;
		private $firstname;
		private $lastname;
		private $email;
		private $query;
	
		public function Edit()
		{
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

			$this->email = $_POST['email'];
			$this->firstname = $_POST['firstName'];
			$this->lastname = $_POST['lastName'];

			$this->query = "UPDATE EECSUsers SET Email='$this->email', FirstName='$this->firstname', LastName='$this->lastname' WHERE user_id='".$_SESSION['username']."'";
		}
		
		private function isOK()
		{
			if($this->mysqli->connect_errno) 
			{
				printf("Connect failed: %s\n", $this->mysqli->connect_error);
				exit();
			}
		}
		
		private function redirectPage()
		{
			header("Location: ProfileFrontEnd.html", TRUE, 303);
		}
		
		
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
