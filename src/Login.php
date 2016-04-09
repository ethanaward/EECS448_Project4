<?php

session_start();

  class Login {

    private $query;
    private $mysqli;
    private $username;
    private $password;

    public function Login() {
      $this->username = $_POST["username"];
      $this->password = $_POST["password"];

      $this->query = "SELECT Password FROM EECSUsers WHERE user_id = '$this->username'";

      $this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
    }

    private function isOK() {
      if($this->mysqli->connect_errno) {
        printf("Connect failed: %s\n", $this->mysqli->connect_error);
        exit();
      }
    }

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
