<?php

  session_start();

  class Follow {

  private $query;
  private $mysqli;

  public function Follow() {
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

  public function addFriend($user, $friend) {
    $this->isOK();
    $this->query = "INSERT INTO ". $user."_Friends (user_id) VALUES ('"  .$friend. "')";

    if($this->mysqli->query($this->query)) {

    } else {
        echo "Error: ".$this->query."<br>".$this->mysqli->error;
    }

  }

  public function addForum($user, $forum) {
    $this->isOK();
    $query = "INSERT INTO ". $user."_Forums (user_id) VALUES ('"  .$forum. "')";

    if($this->mysqli->query($this->query)) {

    } else {
        echo "Error: ".$this->query."<br>".$this->mysqli->error;
    }
  }

  public function removeFriend($user, $friend){

  }

  public function removeForum($user, $forum) {


  }

  }

?>
