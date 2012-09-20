<?php
define('APP_ID', '346459112112091');
define('APP_SECRET', '5496850cbe8b7e287c28fd44de02ac14');
require('./FB/src/facebook.php');
require('./User.php');

$FB = new Facebook( array(
		'appId'  => APP_ID,
  		'secret' => APP_SECRET));

// Get User ID
$user = $facebook->getUser();

if ($user) {
	try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_profile = $facebook->api('/me');
	} catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	}
}

// Login or logout url will be needed depending on current user state.
if (!$user) {
	$loginUrl = $facebook->getLoginUrl(array('scope'=>'user_likes','email','user_status','friends_likes'));
}
else {
	$user = new User($FB);
}
?>

<div id="fb-root"></div>

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
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>


<?php

    echo "seems to be coool though test test test";
    
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"/>

<script>
FB.api('/me', function(response) {
  alert('Your name is ' + response.name);
});
</script>
