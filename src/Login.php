<?php
/**
*	@file : Login.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Authenticates user login information
*/
session_start();
  class Login {

    private $query;
    private $mysqli;
    private $username;
    private $password;

	/**
	*  @name Login
	*  @pre HTML form data submitted
	*  @post Initializes variables and MySQL database
	*  @return none
	*/
    public function Login() {
      $this->username = $_POST["username"];
      $this->password = $_POST["password"];

      $this->query = "SELECT Password FROM EECSUsers WHERE user_id = '$this->username'";

      $this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
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
	*  @name run
	*  @pre Database connected
	*  @post Authenticates login
	*  @return none
	*/

    public function run() {
      $this->isOK();


      if($result = $this->mysqli->query($this->query)) {

        $row_num = mysqli_num_rows($result);

        $row = $result->fetch_assoc();

        if($row_num > 0) {
          if($row['Password'] == $this->password) {
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

      $this->mysqli->close();

    }

  }


?>
