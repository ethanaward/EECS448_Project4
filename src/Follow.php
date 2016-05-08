<?php

  session_start();
/**
 *  @file Follow.php
 *  @author: Ethan Ward
 *  @date: 04.24.16
 *  @brief: Contains functionality for allowing users to add and remove friends or followed forums
 */
  class Follow {

  private $query;
  private $mysqli;
  
  /**
   *  @name: Follow
   *  
   *  @pre: None
   *  @post: A Follow object is created and the database is connected to
   *  @return: None
   */
  public function Follow() {
    $this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');
  }
  /**
   *  @name: isOK
   *  
   *  @pre: None
   *  @post: Displays an error message if the database cannot be connected to
   *  @return: None 
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
   *  @pre: Connected to database
   *  @post: Closes the connection
   *  @return: None
   */
  public function close() {
    $this->mysqli->close();
  }
  /**
   *  @name: addFriend
   *  
   *  @pre: Connected to database, the user and friend exist
   *  @post: Adds the friend to the user's friend table
   *  @param [in] $user : The user whose table the friend is added to
   *  @param [in] $friend : The friend to be added
   *  @return: True if the friend is added, false if not
   */
  public function addFriend($user, $friend) {
    $this->isOK();
    $this->query = "INSERT INTO ". $user."_Friends (user_id) VALUES ('"  .$friend. "')";

    if($this->mysqli->query($this->query)) {
		return true;
    } else {
        return false;
    }

  }
  /**
   *  @name: addForum
   *  
   *  @pre: Connected to database, the user and forum exist
   *  @post: Adds the forum to the user's table
   *  @param [in] $user : The user whose table is added to
   *  @param [in] $forum : The forum to be added
   *  @return: True if the forum is added, false if not
   */
  public function addForum($user, $forum) {
    $this->isOK();
    $this->query = "INSERT INTO ". $user."_Forums (forum_id) VALUES ('"  .$forum. "')";

    if($this->mysqli->query($this->query)) {
		return true;
    } else {
        return false;
    }
  }
  /**
   *  @name: removeFriend
   *  
   *  @pre: Connected to database, the user exists and the friend is in their friends table
   *  @post: Removes the friend from the user's friend list if possible
   *  @param [in] $user : The user whose table is to be removed from
   *  @param [in] $friend : The friend to remove
   *  @return: True if the friend is removed, false if not
   */
  public function removeFriend($user, $friend){
      $this->isOK();
      $this->query = "DELETE FROM " . $user ."_Friends WHERE user_id='". $friend . "'";

      if($this->mysqli->query($this->query)) {
		return true;
      } else {
          return false;
      }
  }
  /**
   *  @name: removeForum
   *  
   *  @pre: Connected to database, the user exists and the forum is in their table
   *  @post: Removes the forum from the user's table if possible
   *  @param [in] $user : The user whose table is to be removed from
   *  @param [in] $forum : The forum to remove
   *  @return: True if the forum is removed, false if not
   */
  public function removeForum($user, $forum) {
    $this->isOK();
    $this->query = "DELETE FROM " . $user ."_Forums WHERE forum_id='". $forum . "'";

    if($this->mysqli->query($this->query)) {
		return true;
    } else {
        return false;
    }

  }

  }

?>
