/**
*	@file : SignUp.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new user in MySQL database
*/


<?php
  session_start();

	class SignUp {
	
	private $mysqli;
	private $username;
	private $firstname;
	private $lastname;
	private $email;
	private $password;
	private $sql;
	
	public function SignUp()
	{
		
		$this->mysqli = new mysqli("mysql.eecs.ku.edu", "eward", "ethanward", "eward");
		$this->username = $_POST["username"];
		$this->firstName = $_POST["firstName"];
		$this->lastName = $_POST["lastName"];
		$this->email = $_POST["email"];
		$this->password = $_POST["passwordFirst"];
		$this->sql = "INSERT INTO EECSUsers (user_id, FirstName, LastName, Email, Password) VALUES ('$this->username', '$this->firstName', '$this->lastName', '$this->email', '$this->password')";

	}
	
	private function redirectPage()
	{
	 
		header("Location: ProfileFrontEnd.html", TRUE, 303);
	
	}

	public function runQuery()
	{
	
		if($this->mysqli->query($this->sql))
		{
      		$_SESSION['username'] = $this->username;
      		$_SESSION['profilename'] = $this->username;
		}
		else
		{
			echo "Error: " . $this->sql . "<br>" . $this->mysqli->error;
		}
		/* close connection */
		$this->mysqli->close();
		
		$this->redirectPage();
	
	}

	



}
?>
