<?php

/**
*	@file : Profile.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Displays user profile information from database
*/

session_start();

  class Profile
  {

    private $query;
    private $mysqli;
	private $isAdmin;
	
	/**
	*  @name: Profile
	*  @pre: None
	*  @post: MySQL database and query are initialized
	*  @return: none
	*/
    public function Profile()
    {
        $this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
        
		$this->query = "SELECT * FROM EECSUsers WHERE user_id = '".$this->mysqli->real_escape_string($_SESSION['profilename'])."'";

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
    public function close()
    {
		$this->mysqli->close();
    }

	/**
	*  @name display
	*  @pre Connected to database, the user exists
	*  @post Displays all the information for the user, including a form for editing if the user is viewing their own profile
	*  @return True if the information can be displayed, false otherwise
	*/
    public function display()
    {
    	$this->isOK();
		if($_SESSION['username'] == $_SESSION['profilename'])
		{
			if($result = $this->mysqli->query($this->query))
			{
				echo "<form action = 'EditProfile.php' method = 'post'>";
				echo "<table style = 'display: inline-block'>";
				while($row = $result->fetch_assoc())
				{
					printf("<tr> <td>Username:</td><td> %s</td> </tr>
					<tr> <td>Email address:</td><td><input type = 'text' name = 'email' value = '%s'></td> </tr>
					<tr> <td>First Name:</td><td> <input type = 'text' name = 'firstName' value = '%s'></td> </tr>
					<tr> <td>Last Name:</td><td><input type = 'text' name = 'lastName' value = '%s'></td> </tr>
					<tr> <td>Website:</td><td><input type = 'text' name = 'website' value = '%s'</td> </tr>
					<tr> <td>Description:</td><td><input type = 'text' name = 'description' value = '%s'</td> </tr>",
					htmlspecialchars($row["user_id"]), htmlspecialchars($row["Email"]), htmlspecialchars($row["FirstName"]), htmlspecialchars($row["LastName"]), htmlspecialchars($row["Website"]), htmlspecialchars($row["Description"]));
					
					$this->isAdmin = $row['isAdmin'];
				}
			


				echo "<tr><td><input type = 'submit' value = 'Edit profile'></td></tr>";
				echo "</table>";
				echo "</form>";
			
				$result->free();
				
				return true;
			}
			else {
				return false;
			}
			
		}
		else
		{
			if($result = $this->mysqli->query($this->query))
			{
				echo "<table style = 'display: inline-block'>";
				while($row = $result->fetch_assoc())
				{
					printf("<tr> <td>Username:</td><td> %s</td> </tr>
					<tr> <td>First Name:</td><td>%s</td> </tr>
					<tr> <td>Last Name:</td><td>%s</td> </tr>
					<tr> <td>Website:</td> <td>%s</td> </tr>
					<tr> <td>Description: </td> <td>%s</td> </tr>",
          htmlspecialchars($row["user_id"]), htmlspecialchars($row["FirstName"]), htmlspecialchars($row["LastName"]), htmlspecialchars($row["Website"]), htmlspecialchars($row["Description"]));
				}
				echo "</table>";
				$result->free();
				return true;
			}
			else {
				return false;
			}
		}
    }

  /**
   *  @name: 
   *  
   *  @pre:
   *  @post:
   *  @return: 
   */
  public function displayButton() {

    //include "src/Utility.php";
    $utility = new Utility();


    if(isset($_SESSION['username']))
    {
    	if(($_SESSION['username'] != $_SESSION['profilename']))
    	{
    		if(! ($utility->checkFriend( $_SESSION['username'], $_SESSION['profilename'] )) )
    		{
    			echo "<form action = 'changeFriend.php?action=1' method = 'post'>";
    			printf("<input type = 'hidden' name = 'Profile' value = '%s'>", $_SESSION['profilename']);
    			echo "<button type = 'submit'>Add as friend</button>";
    			echo "</form>";
    		}

    		else
    		{
    			echo "<form action = 'changeFriend.php?action=2' method = 'post'>";
    			printf("<input type = 'hidden' name = 'Profile' value = '%s'>", $_SESSION['profilename']);
    			echo "<button type = 'submit'>Remove as friend</button>";
    			echo "</form>";
    		}
    	}
    }
  }

	/**
	 *  @name: 
	 *  
	 *  @pre:
	 *  @post:
	 *  @return: 
	 */
	public function displayAdmin(){
		if($this->isAdmin == 1)
		{
			echo "<br><br><a href='Admin.html'>Admin Page</a>";
		}
	}
}

?>
