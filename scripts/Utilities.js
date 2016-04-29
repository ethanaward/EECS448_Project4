var myDate;

function getTheDate(){
	myDate = new Date();

	var dateString = myDate.getDate().toString() + " " + getMonthName() + " " + myDate.getFullYear().toString() + " " + getTimeString();
	document.getElementById("date").value = dateString;
	//document.getElementById("date").value = "hello though";
	document.getElementById("date").type = "hidden";
}

function getMonthName(){
	var dateString = "";
	var dateNum = myDate.getMonth();
	if(dateNum==0){
		dateString = "January";
	}
	else if(dateNum==1){
		dateString = "February";
	}
	else if(dateNum==2){
		dateString = "March";
	}
	else if(dateNum==3){
		dateString = "April";
	}
	else if(dateNum==4){
		dateString = "May";
	}
	else if(dateNum==5){
		dateString = "June";
	}
	else if(dateNum==6){
		dateString = "July";
	}
	else if(dateNum==7){
		dateString = "August";
	}
	else if(dateNum==8){
		dateString = "September";
	}
	else if(dateNum==9){
		dateString = "October";
	}
	else if(dateNum==10){
		dateString = "November";
	}
	else if(dateNum==11){
		dateString = "December";
	}
	return dateString;
}

function getTimeString(){
	var timeString = "";
	var hours = + parseInt(myDate.getHours());
	var minutes = + parseInt(myDate.getMinutes());
	timeString = hours + ":" + minutes;
	return timeString;
}

function toggleRecentPosts(){
	var myDiv = document.getElementById("recentPosts")
	var myTitle = document.getElementById("recentPostsTitle")
	if(myDiv.style.visibility=="hidden"){
		myDiv.style.visibility = "visible";
		myTitle.innerHTML = "Hide My Posts";
	}
	else{
		myDiv.style.visibility = "hidden";
		myTitle.innerHTML = "Show My Posts";
	}
}
