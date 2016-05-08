<?php
/**
*	@file : User.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Authenticates user login/signup information
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
	* 
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
	* 
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
  	 *  @name: redirectPage
  	 *  
  	 *  @pre: None
  	 *  @post: Redirects the user to the proper page
  	 *  @param [in] $val : A value used to check where the user should be redirected to
  	 *  @return: None
  	 */
  	public function redirectPage($val)
  	{
		if($val == 1) {
			header("Location: ProfileFrontEnd.html", TRUE, 303);
		}
		else if ($val == 0) {
			$_SESSION['message'] = "Login failed";
			header("Location: LoginFrontEnd.html", TRUE, 303);
		}
		else if ($val == 2) {
			$_SESSION['message'] = "Signup failed";
			header("Location: SignupFrontEnd.html", TRUE, 303);
		}
  		

  	}
    /**
     *  @name: close
     *  
     *  @pre: Connected to database
     *  @post: The mysqli is closed
     *  @return: None
     */
    public function close() {
      $this->mysqli->close();
    }

	/**
	*  @name: login
	* 
	*  @pre: Database connected
	*  @post: Authenticates login
	*  @return: 0 if the login failed, 1 if it succeeded
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
            return 1;
			}

			else {
				return 0;
			}
        }
        else
        {
			return 0;
        }

      }
	  else {
		return 0;
	  }
    }

    /**
  	*  @name: signup
  	*  @pre: Gathered HTML form data
  	*  @post: New user is created if possible, nothing otherwise
  	*  @return: 1 if the signup was successful, 2 if it was not
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
				$this->createFriends();
				$this->createForums();
				return 1;
  		}
  		else
  		{
  			return 2;
  		}
  	}
    /**
     *  @name: createFriends
     *  
     *  @pre: Connected to database, a user has been added to the database
     *  @post: Creates a user's friend table
     *  @return: True if the table was created, false otherwise
     */
    private function createFriends() {

      $this->query = "CREATE TABLE ". $this->username ."_Friends (user_id varchar(255) NOT NULL, FOREIGN KEY(user_id) REFERENCES EECSUsers(user_id)) ENGINE=InnoDB";

      if($this->mysqli->query($this->query)) {
            return true;

      }
      else
  		{
            echo "Error: " . $this->query . "<br>" . $this->mysqli->error;
            return false;
      }

    }
    /**
     *  @name: createForums
     *  
     *  @pre: Connected to database, a user has been added to the database
     *  @post: Creates a user's forums talble
     *  @return: True if the table was created, false otherwise
     */
    private function createForums() {

      $this->query = "CREATE TABLE ". $this->username ."_Forums (forum_id varchar(255) NOT NULL) ENGINE=InnoDB";

      if($this->mysqli->query($this->query)) {
          return true;
      }
      else
      {
          echo "Error: " . $this->query . "<br>" . $this->mysqli->error;
          return false;
      }

    }
    /**
     *  @name: deleteUser
     *  
     *  @pre: Connected to database, the user taken in exists
     *  @post: Deletes the user and all of their associated data if possible
     *  @param [in] $user : The user to be deleted
     *  @return: True if the user was deleted, false otherwise
     */
    public function deleteUser($user) {

        $this->deleteForums($user);
        $this->deleteFriends($user);
        $this->deleteFromFriends($user);

        $this->query = "DELETE FROM EECSUsers WHERE user_id = '$user'";

        if($this->mysqli->query($this->query)) {
            return true;
        }
        else
        {
            echo "Error: " . $this->query . "<br>" . $this->mysqli->error;
            return false;
        }


    }
    /**
     *  @name: deleteFriends
     *  
     *  @pre: Connected to database, a user of the given name exists
     *  @post: Deletes the user's friends table if possible
     *  @param [in] $user : The user to delete the friends table of
     *  @return: True if the table was deleted, false otherwise
     */
    private function deleteFriends($user) {

        $this->query = "DROP TABLE ". $user . "_Friends";

        if($this->mysqli->query($this->query)) {
            return true;
        }
        else
        {
            echo "Error: " . $this->query . "<br>" . $this->mysqli->error;
            return false;
        }

    }
    /**
     *  @name: deleteForums
     *  
     *  @pre: Connected to database, a user of the given name exists
     *  @post: Deletes the user's forums table if possible
     *  @param [in] $user : The user to delete the forums table of
     *  @return: True if the table was deleted, false otherwise
     */
    private function deleteForums($user) {

        $this->query = "DROP TABLE ". $user . "_Forums";

        if($this->mysqli->query($this->query)) {
            return true;
        }
        else
        {
            echo "Error: " . $this->query . "<br>" . $this->mysqli->error;
            return false;
        }

    }
    /**
     *  @name: deleteFromFriends
     *  
     *  @pre: Connected to database
     *  @post: Deletes the given user from the friends table of all users
     *  @param [in] $user : The user to delete from friends tables
     *  @return: True if the user was removed from the tables, false otherwise
     */
    private function deleteFromFriends($user) {

        $this->query = 'SELECT * FROM EECSUsers';

        if($result = $this->mysqli->query($this->query)) {
            while($row = $result->fetch_assoc()) {
                $this->query = "DELETE FROM ". $row['user_id'] . "_Friends WHERE user_id = '$user'";
                $this->mysqli->query($this->query);
            }
			return true;
        }
        else
        {
            echo "Error: " . $this->query . "<br>" . $this->mysqli->error;
            return false;
        }
    }


  }


?>
