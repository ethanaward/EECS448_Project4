<?php

/**
*	@file : SignUp.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Creates new user in MySQL database
*/
  session_start();

	class SignUp {

	private $mysqli;
	private $username;
	private $firstname;
	private $lastname;
	private $email;
	private $password;
	private $sql;


	/**
	*  @name SignUp
	*  @pre Submitted form data
	*  @post The form data is saved to variables and the database called
	*  @return none
	*/
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

  public function close() {
    $this->mysqli->close();
  }


	/**
	*  @name runQuery
	*  @pre Gathered HTML form data
	*  @post New user is created
	*  @return none
	*/
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


    $this->createFriends();
    $this->createForums();

		$this->redirectPage();

	}

  private function createFriends() {

    $this->sql = "CREATE TABLE ". $this->username ."_Friends (user_id varchar(255) NOT NULL, FOREIGN KEY(user_id) REFERENCES EECSUsers(user_id)) ENGINE=InnoDB";

    if($this->mysqli->query($this->sql)) {

    }
    else
		{
			echo "Error: " . $this->sql . "<br>" . $this->mysqli->error;
    }

  }

  private function createForums() {

    $this->sql = "CREATE TABLE ". $this->username ."_Forums (forum_id varchar(255) NOT NULL) ENGINE=InnoDB";

    if($this->mysqli->query($this->sql)) {

    }
    else
    {
      echo "Error: " . $this->sql . "<br>" . $this->mysqli->error;
    }

  }
}
?>
