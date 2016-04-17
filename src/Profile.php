


<?php

/**
*	@file : Profile.php
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Displays user profile information from database
*/

session_start();

  class Profile {

    private $query;
    private $mysqli;

	/**
	*  @name Profile
	*  @pre None
	*  @post MySQL database is initialized
	*  @return none
	*/
    public function Profile() {
      $this->query = "SELECT * FROM EECSUsers WHERE user_id = '".$_SESSION['profilename']."'";
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
	*  @name display
	*  @pre None
	*  @post Displays HTML form for editing profile
	*  @return none
	*/
    public function display() {
    	$this->isOK();
      if($_SESSION['username'] == $_SESSION['profilename']) {

          if($result = $this->mysqli->query($this->query)) {
          echo "<form action = 'EditProfile.php' method = 'post'>";
            echo "<table style = 'display: inline-block'>";
            while($row = $result->fetch_assoc()) {

              printf("<tr> <td>Username:</td><td> %s</td> </tr>
              <tr> <td>Email address:</td><td><input type = 'text' name = 'email' value = '%s'></td> </tr>
              <tr> <td>First Name:</td><td> <input type = 'text' name = 'firstName' value = '%s'></td> </tr>
              <tr> <td>Last Name:</td><td><input type = 'text' name = 'lastName' value = '%s'></td> </tr>
              <tr> <td>Website:</td><td><input type = 'text' name = 'website' value = '%s'</td> </tr>
              <tr> <td>Description:</td><td><input type = 'text' name = 'description' value = '%s'</td> </tr>",
              $row["user_id"], $row["Email"], $row["FirstName"], $row["LastName"], $row["Website"], $row["Description"]);
            }
            echo "<tr><td><input type = 'submit' value = 'Edit profile'></td></tr>";

            echo "</table>";

            echo "</form>";
            $result->free();
          }
      }

      else {
        if($result = $this->mysqli->query($this->query)) {

          echo "<table style = 'display: inline-block'>";
          while($row = $result->fetch_assoc()) {

            printf("<tr> <td>Username:</td><td> %s</td> </tr>
            <tr> <td>First Name:</td><td>%s</td> </tr>
            <tr> <td>Last Name:</td><td>%s</td> </tr>
            <tr> <td>Website:</td> <td>%s</td> </tr>
            <tr> <td>Description: </td> <td>%s</td> </tr>",
            $row["user_id"], $row["FirstName"], $row["LastName"], $row["Website"], $row["Description"]);
          }
          echo "</table>";
          $result->free();

        }
      }
    }

    public function displayFollowed() {

      $this->query = "SELECT * FROM ". $_SESSION['profilename']."_Friends";

      if($_SESSION['username'] == $_SESSION['profilename']) {
        if($result = $this->mysqli->query($this->query)) {
          echo "<table style = 'display: inline-block'>";
          echo "<tr><td>Friends List</td></tr>";
          while($row = $result->fetch_assoc()) {
            printf("<tr> <td><a href = ProfileFrontEnd.html?profile=%s>%s</a></td> </tr>", $row['user_id'], $row['user_id']);
          }
          echo "</table";
          }

      }
      else {
        if($result = $this->mysqli->query($this->query)) {
          echo "<table style = 'display: inline-block'>";
          echo "<tr><td>Friends List</td></tr>";
          while($row = $result->fetch_assoc()) {
            printf("<tr> <td><a href = ProfileFrontEnd.html?profile=%s>%s</a></td> </tr>", $row['user_id'], $row['user_id']);
          }
          echo "</table";
        }
        else {

        }
      }
      $this->mysqli->close();
    }
  }

?>
