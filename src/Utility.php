<?php
/**
 *  @file Utility.php
 *  @author: Mike Neises, Travis Augustine, Ethan Ward
 *  @date: 2016.04.30
 *  @brief Contains functions for verification purposes
 */
  session_start();

  class Utility {

  private $query;
  private $mysqli;
  /**
   *  @name: Utility
   *  
   *  @pre: None
   *  @post: Creates a new Utility object and initializes its mysqli
   *  @return None
   */
  public function Utility() {
    $this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
  }
  /**
   *  @name: isOK
   *  
   *  @pre: None
   *  @post: Prints an error message if connection failed
   *  @return None
   */
  private function isOK() {
    if($this->mysqli->connect_errno) {
      printf("Connect failed: %s\n", $this->mysqli->connect_error);
      exit();
    }
  }
  /**
   *  @name: close
   *  
   *  @pre:	Connected to database
   *  @post: Closes the connection
   *  @return: None
   */
  public function close() {
    $this->mysqli->close();
  }
  /**
   *  @name: checkUser
   *  
   *  @pre: Connected to database
   *  @post: None
   *  @param [in] $user: A user id that will be checked against the database
   *  @return: True if the user is in the database, false if it is not or if the query fails
   */
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
		else {
			return false;
		}

  }
  /**
   *  @name: checkFriend
   *  
   *  @pre: Connected to database
   *  @post: None
   *  @param [in] $user   : A user id whose friend table will be checked
   *  @param [in] $friend : A user id which will be checked against the friend table
   *  @return: True if the friend exists in the user's friend table, false if it is not or if the query fails
   */
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
	  else {
		return false;
	  }

  }
  /**
   *  @name: checkForum
   *  
   *  @pre: Connected to database
   *  @post: None
   *  @param [in] $user  : A user id whose forum table will be checked
   *  @param [in] $forum : A forum id which will be checked against the forum table
   *  @return: True if the user has the forum in their forum table, false if it is not or if the query fails
   */
  public function checkForum($user, $forum) {
    $this->isOK();
    $this->query = "SELECT count(1) FROM ".$user."_Forums WHERE forum_id='". $forum ."'";
	
    if($result = $this->mysqli->query($this->query)) {
        $row = $result->fetch_assoc();
        if($row['count(1)']) {
          return true;
        }
        else {
          return false;
        }
    } else {
		return false;
	}

  }
   /**
   *  @name: checkBoard
   *  
   *  @pre: Connected to database
   *  @post: None
   *  @param [in] $board : A board id to be checked against the database
   *  @return: True if the board is in the database, false if it is not or if the query fails.
   */
  public function checkBoard($board) {
	$this->isOK();
	$this->query = "SELECT count(1) FROM EECSForums WHERE forum_id = '". $board ."'";
	
	if($result = $this->mysqli->query($this->query)) {
		$row = $result->fetch_assoc();
		if($row['count(1)']) {
			return true;
		}
		else {
			return false;
		}
	}
	else {
		return false;
	}
	
  }
  
  }

?>
