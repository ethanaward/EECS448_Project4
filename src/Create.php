<?php
session_start();
/*
* Author: Michael Neises
* Date Modified: April 8, 2016
* Purpose: to add a post to the EECSPosts database
*/
	class Create
	{

		private $post;
		private $user;
		private $here;
		private $query;
		private $mysqli;

		public function Create()
		{

			//These two variables hold the post content and the username of the poster respectively.
			$this->post = $_POST["mypost"];
			$this->user = $_SESSION["username"];
			//This variable is used to see if the user_id exists within the EECSUsers database.
			$this->here = false;

			//Here we initialize the connection to the database.
			$this->mysqli = new mysqli('mysql.eecs.ku.edu', 'eward', 'ethanward', 'eward');


			//Here I escape the post return into a correctly formatted string.
			//Example: without this line, if the post contains a single apostrophe ("I'm coding."),
			//Then that apostrophe will confuse the query and the program crashes.
			$this->post = $this->mysqli->real_escape_string($this->post);


			//This query we will use to add the post with the username into the EECSPosts database.
			$this->query = "INSERT INTO EECSPosts (content, user_id) VALUES('$this->post', '$this->user')";

		}

		private function isOK()
		{
			/* check connection */
			if ($this->mysqli->connect_errno)
			{
				printf("Connect failed: %s\n", $this->mysqli->connect_error);
				exit();
			}
		}

		public function makePost()
		{
			//Test to make sure the database can be accessed
			$this->isOK();

			//See echos for explanations inside this conditional.
			if($this->mysqli->query($this->query)==TRUE) {
					echo "New post created successfully!";
				}
			} else {
					echo "Error: ".$this->query."<br>".$this->mysqli->error;
			}

			//close connection
			$this->mysqli->close();


		}

	}
?>
