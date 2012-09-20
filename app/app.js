var Eruptive = {
  pageLoaded: function() 
  {
	// page loaded, init the game!
     FB.api('/me', function(response) {
       $("#username").html( "Player name: " + response.name );
     });
     
	 alert('initialized!');
  }
		
}; // Eruptive


$().ready()
{

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

      
}





function Telem(elid){
	return document.getElementById(elid);
}

var cursor;
window.onload = init;

function init(){
	cursor = Telem("cursor");				
	cursor.style.left = "0px";
}

function nl2br(txt){
	return txt.replace(/\n/g, "<br />");
}

function writeit(from, e){
	e = e || window.event;
	var w = Telem("writer");
	var tw = from.value;
	w.innerHTML = nl2br(tw);
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

function alert(txt){
	console.log(txt);
}