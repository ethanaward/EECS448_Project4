/**
*	@file : InputValidator.js
*	@author : Mike Neises, Travis Augustine, Ethan Ward
*	@date : 2016.04.08
*	@brief: Checks for valid input
*/

function InputValidator()
{

	/**
	*  @name checkPost
	*  @pre Submitted feed post form
	*  @post None
	*  @return true if passes, false if error
	*/
	this.checkPost = function()
	{
		var post = document.getElementById('post').value;
		if(post.length < 1)
		{
			alert('Post field is blank.');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	
	/**
	*  @name checkPostTopic
	*  @pre Submitted forum post form
	*  @post None
	*  @return true if passes, false if error
	*/
	this.checkPostTopic = function()
	{
		var post = document.getElementById('post').value;
		var topic = document.getElementById('topic').value;
		if(topic.length < 1)
		{
			alert('Topic field is blank');
			return false;
		}
		else if(post.length < 1)
		{
			alert('Post field is blank.');
			return false;
		}
		else
		{
			return true;
		}
	}
	
	/**
	*  @name checkLogin
	*  @pre Submitted login form
	*  @post None
	*  @return true if passes, false if error
	*/
	this.checkLogin = function()
	{
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;

		if(username.length < 1)
		{
			alert('Username field is blank.');
			return false;
		}
		else if(password.length < 1)
		{
			alert('Password field is blank.');
			return false;
		}
		else
		{
			return true;
		}
	}
		
	/**
	*  @name checkSignUp
	*  @pre Submitted sign up form
	*  @post None
	*  @return true if passes, false if error
	*/
	this.checkSignUp = function()
	{
		var password = document.getElementById('password').value;
		var passwordSecond = document.getElementById('passwordSecond').value;
		
		if(password == passwordSecond)
		{
			if(password.length < 8)
			{
				alert('Password must be at least 8 characters.');
				return false;
			}
		}
		else if(password != passwordSecond)
		{
			alert('Passwords do not match.');
			return false;
		}
		else
		{
			return true;
		}	
	}
}

