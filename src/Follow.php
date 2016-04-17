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


  }

  public function addForum($user, $forum) {

  }

  public function removeFriend($user, $friend){

  }

  public function removeForum() {

    
  }

  }

?>
