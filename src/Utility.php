<?php

  session_start();

  class Utility {

  private $query;
  private $mysqli;

  public function Utility() {
    $this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
  }

  private function isOK() {
    if($this->mysqli->connect_errno) {
      printf("Connect failed: %s\n", $this->mysqli->connect_error);
      exit();
    }
  }

  public function close() {
    $this->mysqli->close();
  }

  public function checkUser($user) {
    	$this->isOK();
      $this->query = "SELECT count(1) FROM EECSUsers WHERE user_id='". $user ."'";
        if($result = $this->mysqli->query($this->query)) {
          $row = $result->fetch_assoc();
          if($row['count(1)']) {
            return true;
          }
          else {
            return false;
          }
        }

  }

  public function checkFriend($user, $friend) {
    $this->isOK();
    $this->query = "SELECT count(1) FROM ".$user."_Friends WHERE user_id='". $friend ."'";
      if($result = $this->mysqli->query($this->query)) {
        $row = $result->fetch_assoc();
        if($row['count(1)']) {
          return true;
        }
        else {
          return false;
        }
      }

  }

  }

?>
