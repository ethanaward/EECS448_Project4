<?php
/**
*	@file : User.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Authenticates user login information
*/
session_start();
  class User {

    private $query;
    private $mysqli;
    private $username;
    private $password;
    private $firstname;
  	private $lastname;
  	private $email;

	/**
	*  @name User
	*  @pre HTML form data submitted
	*  @post Initializes variables and MySQL database
	*  @return none
	*/
    public function User() {
      $this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');

      $this->username = $this->mysqli->real_escape_string($_POST['username']);
      $this->password = $this->mysqli->real_escape_string($_POST['password']);


    }

	/**
	*  @name isOK
	*  @pre None
	*  @post Prints error if connection failed
	*  @return none
	*/
    private function isOK() {
      if($this->mysqli->connect_errno) {
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

    public function close() {
      $this->mysqli->close();
    }

	/**
	*  @name login
	*  @pre Database connected
	*  @post Authenticates login
	*  @return none
	*/

    public function login() {
      $this->isOK();

      $this->query = "SELECT Password FROM EECSUsers WHERE user_id = '$this->username'";

      if($result = $this->mysqli->query($this->query)) {

        $row_num = mysqli_num_rows($result);

        $row = $result->fetch_assoc();

        if($row_num > 0) {
          if(password_verify($this->password,$row['Password']) ) {
            $_SESSION["profilename"] = $this->username;
            $_SESSION["username"] = $this->username;
            header("Location: ProfileFrontEnd.html", TRUE, 303);
            exit();
          }

          else {
            echo "Error: Incorrect password<br>";
            echo "<a href = LoginFrontEnd.html>Back</a>";
          }
        }
        else
        {
          echo "Error: Username does not exist";
          echo "<br>";
          echo "<a href='LoginFrontEnd.html'>Back</a>";
        }

      }
    }

    /**
  	*  @name signup
  	*  @pre Gathered HTML form data
  	*  @post New user is created
  	*  @return none
  	*/
  	public function signup()
  	{

      $this->firstName = $this->mysqli->real_escape_string($_POST["firstName"]);
  		$this->lastName = $this->mysqli->real_escape_string($_POST["lastName"]);
  		$this->email = $this->mysqli->real_escape_string($_POST["email"]);
      $this->password = password_hash($this->password, PASSWORD_DEFAULT);

      $this->query = "INSERT INTO EECSUsers (user_id, FirstName, LastName, Email, Password)
                                   VALUES ('$this->username', '$this->firstName', '$this->lastName', '$this->email', '$this->password')";

  		if($this->mysqli->query($this->query))
  		{
        		$_SESSION['username'] = $this->username;
        		$_SESSION['profilename'] = $this->username;
  		}
  		else
  		{
  			echo "Error: " . $this->query . "<br>" . $this->mysqli->error;
  		}
  		
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
