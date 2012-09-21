var Eruptive = {

  userInfo: {
	  // template of the user info we have from DB:
	  name: "",
	  energy: 0,
	  xp: 0,
	  level: 0,
	  health: 0,
	  attack: 0,
	  defense: 0,
	  weapon_id: 0,
	  armor_id: 0	  
  },
		
  pageLoaded: function() 
  {
	// page loaded, init the game!
	Eruptive.updateUserInfo( true );
	alert('initialized!');
  },
  updateUserInfo: function( init )
  {
	// let's pull user's data...
    $.ajax({url: '/app/api.php', 
    	type: "POST", 
    	dataType: 'json', 
    	data: { 
    		method: "getUserInfo"
    	}, 
    	success: function(data) {
    		Eruptive.userInfo = data;
    		alert('user info received, stored in Eruptive.userInfo');
			if (init==true && Eruptive.userInfo.name!=null)
				printf( "Hello " + Eruptive.userInfo.name + ', welcome back to Gastown!' );
    	}
    });
  },
  sendWallPost: function()
  {
	  alert('about to send wallpost');
	  
  }
  
  
  //points

		
}; // Eruptive


window.fbAsyncInit = function() {

    FB.init({
        appId      : '346459112112091', // App ID
        oauth : true,
        channelUrl : '//fbhackeruptive2.icsoft.ca/channel.php', // Channel File
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : false  // parse XFBML
      });

      FB.login(function(response) {
    	  Eruptive.pageLoaded();
     });

      
};

var health = 15;
var maxhealth = 20;
var gold =500;
var strength = 20;
var attack = 10;
var defense = 10;
var energy = 10;
var name = "Jeff Day";

var area = 'main';

var keyCommand;

function $$(elid){
	return document.getElementById(elid);
}

var cursor;
window.onload = init;

function displayPrompt()
{
	printf("\n\nHealth (" + health + " of " + maxhealth + ") Gold: " + gold + " Energy: " + energy + "\n");
	printf("Command, " + name + ": ");
}

function mainMenu()
{
	printf("<img src='http://fbhackeruptive2.icsoft.ca/Banner.jpg'/>\n");
	printf("\n\nGastown Text Adventure -------------------------------------------------------\n");
	printf("-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n\n");
	printf("(G) Go to the Cambie\n");
	printf("(F) Woodwards battle arena (Fight friends)\n");
	printf("(R) Roam the streets of Gastown\n") 
	printf("(S) View Stats\n");
	printf("(A) Friend activity\n");

	displayPrompt();

	var objDiv = document.getElementById("terminal");
	objDiv.scrollTop = objDiv.scrollHeight;

	
}

function mainInn()
{
	printf("\n\n\n\n<span style='color: white'>THE CAMBIE </span> -------------------------------------------------------\n");
	printf("-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n\n");
	printf("(K) Talk to Inn Keeper\n");
	printf("(B) Approach the bar\n");
	printf("(G) Put on sunglasses\n");
	printf("(M) Call the bar maid\n") 
	printf("(S) Scream 'Who wants a fight'\n");
	printf("(G) Go back to Main Menu");

	displayPrompt();

	var objDiv = document.getElementById("terminal");
	objDiv.scrollTop = objDiv.scrollHeight;

}

function mainBattle()
{
	printf("\n\n\n\n<span style='color: white'>WOODWARDS BATTLE ARENA </span> -------------------------------------------------------\n")
	printf("-=-=-=-=-=-=-=-=-=--=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-\n\n");
	printf("XXX is calling you out! Are you ready to battle?\n");
	printf("(F) Fight! Accept the challenge.\n");
	printf("(S) View this guys stats\n");
	printf("(R) Run away... like a little baby.\n");
	
	displayPrompt();

	var objDiv = document.getElementById("terminal");
	objDiv.scrollTop = objDiv.scrollHeight;
	
}


function driverLoop()
{ 

	while (true)
	{

		// get keyboard input
	}
}


function init(){
	//cursor = $$("cursor").css('left','0px');		
	alert('balls');

	$$('setter').focus();
	cursor = $$("cursor");		
	cursor.style.left = "0px";

	mainMenu();

	var objDiv = document.getElementById("terminal");
	objDiv.scrollTop = objDiv.scrollHeight;
}

function printf(text)
{
	var w = $$("writer");
	for(i = 0; i < text; i++){
	   // document.write("<br /> Element " + i + " = " + mySplitResult[i]); 
	    w.innerHTML += nl2br(text[i]);
	}
	
	
	var tw = text;
	w.innerHTML += nl2br(tw);
}

function nl2br(txt){
	return txt.replace(/\n/g, "<br />");
}

function writeit(from, e){
	e = e || window.event;
	var w = $$("writer");
	var tw = from.value;
	alert(tw);
	alert(e.keycode);
	w.innerHTML = nl2br(tw);
}

function moveItJeff(count, value){
	var count = 1;
	var keycode = e.keyCode || e.which;
//	alert(count);
	if(keycode == 37 && parseInt(cursor.style.left) >= (0-((count-1)*10))){
		cursor.style.left = parseInt(cursor.style.left) - 10 + "px";
	} else if(keycode == 39 && (parseInt(cursor.style.left) + 10) <= 0){
		cursor.style.left = parseInt(cursor.style.left) + 10 + "px";
	}

}

function moveIt(count, e){
	e = e || window.event;
	var keycode = e.keyCode || e.which;
//	alert(count);
	if(keycode == 37 && parseInt(cursor.style.left) >= (0-((count-1)*10))){
		cursor.style.left = parseInt(cursor.style.left) - 10 + "px";
	} else if(keycode == 39 && (parseInt(cursor.style.left) + 10) <= 0){
		cursor.style.left = parseInt(cursor.style.left) + 10 + "px";
	}

}

function captureKey(count, e) {
	e = e || window.event;
	var keycode = e.keyCode || e.which;

	var value = String.fromCharCode(e.keyCode).toUpperCase();
	alert(value);

	printf("<span style='color: white'> " + value + "</span>");

	// detect where we are 
	if (area == 'main')
	{
		if (value == 'G')
		{
			area = 'inn';
			mainInn();
		}
		else if (value == 'F')
		{
			arena = 'battle';
			mainBattle();
		}

	}
	else if (area == 'inn')
	{
		if (value == 'G')
		{
			area = 'main';
			mainMenu();
		}
	}
	else if (area == 'battle')
	{
		if (value == 'R')
		{
			area = 'main';
			mainMenu();
		}

	}
	
	var objDiv = document.getElementById("terminal");
	objDiv.scrollTop = objDiv.scrollHeight;
}
	
	function alert(txt){
		console.log(txt);
	}