<div id="fb-root"></div>

<link rel="stylesheet" type="text/css" href="app.css">

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '346459112112091', // App ID
      channelUrl : 'http://fbhackeruptive2.icsoft.ca/channel.php', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional initialization code here
  };

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "http://connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>


<?php

    //echo "seems to be coool though test test test";
    
?>


<script src="//connect.facebook.net/en_US/all.js">
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js">
</script>

<script src="app.js">
</script>

<div id="username">
User name goes here
</div>

<div id="terminal" onclick="Telem('setter').focus();">
	<textarea type="text" id="setter" onkeydown="writeit(this, event);moveIt(this.value.length, event)" onkeyup="writeit(this, event)" onkeypress="writeit(this, event);"></textarea>
	<div id="getter">
		<span id="writer"></span><b class="cursor" id="cursor">B</b>
	</div>
</div>
	







