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
	*  @pre Submitted post form
	*  @post None
	*  @return true if passes, false if error
	*/
	this.checkPost = function()
	{
		var username = document.getElementById('user').value;
		var post = document.getElementById('post').value;

		if(username.length < 1)
		{
			alert('Username field is blank.');
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
		alert('in check login');
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
		var firstName = document.getElementById('firstName').value;
		var lastName = document.getElementById('lastName').value;
		var email = document.getElementById('email').value;
		var username = document.getElementById('username').value;
		var passwordFirst = document.getElementById('passwordFirst').value;
		var passwordSecond = document.getElementById('passwordSecond').value;
		var regex = /^([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)@([0-9a-zA-Z]([-_\\.]*[0-9a-zA-Z]+)*)[\\.]([a-zA-Z]{2,9})$/;
		
		if(firstName.length < 1)
		{
			alert("First name is not valid.");
			return false;
		}

		else if(lastName.length < 1)
		{
			alert("Last name is not valid.");
			return false;
		}

		else if(username.length < 1)
		{
			alert('Username is not valid.');
			return false;
		}

		else if(!regex.test(email))
		{
			alert("Email is not valid.");
			return false;
		}

		else if(passwordFirst == passwordSecond)
		{
			if(passwordFirst.length < 8)
			{
				alert('Password must be at least 8 characters.');
				return false;
			}
		}
		else if(passwordFirst != passwordSecond)
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

