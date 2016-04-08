<?php

session_start();

  class Profile {

    private $query;
    private $mysqli;

    public function Profile() {
      $this->query = "SELECT * FROM EECSUsers WHERE user_id = '".$_SESSION['profilename']."'";
      $this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
    }

    private function isOK() {
      if($this->mysqli->connect_errno) {
        printf("Connect failed: %s\n", $this->mysqli->connect_error);
        exit();
      }
    }

    public function display() {
      if($_SESSION['username'] == $_SESSION['profilename']) {

          if($result = $this->mysqli->query($this->query)) {
          echo "<form action = 'EditProfile.php' method = 'post'>";
            echo "<table>";
            while($row = $result->fetch_assoc()) {

              printf("<tr> <td>Username:</td><td> %s</td> </tr>
              <tr> <td>Email address:</td><td><input type = 'text' name = 'email' value = '%s'></td> </tr>
              <tr> <td>First Name:</td><td> <input type = 'text' name = 'firstName' value = '%s'></td> </tr>
              <tr> <td>Last Name:</td><td><input type = 'text' name = 'lastName' value = '%s'></td> </tr>", $row["user_id"], $row["Email"], $row["FirstName"], $row["LastName"]);
            }
            echo "</table>";
            echo "<input type = 'submit' value = 'Edit profile'>";
            echo "</form>";
            $result->free();


            $this->mysqli->close();
          }
      }

      else {
        if($result = $this->mysqli->query($this->query)) {

          echo "<table>";
          while($row = $result->fetch_assoc()) {

            printf("<tr> <td>Username:</td><td> %s</td> </tr>
            <tr> <td>Email address:</td><td>%s</td> </tr>
            <tr> <td>First Name:</td><td>%s</td> </tr>
            <tr> <td>Last Name:</td><td>%s</td> </tr>", $row["user_id"], $row["Email"], $row["FirstName"], $row["LastName"]);
          }
          echo "</table>";
          $result->free();

          $this->mysqli->close();
        }
      }
    }
  }

?>
