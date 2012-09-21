<?php 

require_once('../FB/src/facebook.php');
require_once("../db.php");
$db = new DB;

//$db->install_tables();

$facebook = new Facebook(array(
  'appId'  => '346459112112091',
  'secret' => 'YOUR_APP_SECRET',
));

$user = $facebook->getUser();

if (!isset($user)) {
	return "NOT AUTHORIZED";
}

try {
  // Proceed knowing you have a logged in user who's authenticated.
  $user_info = $facebook->api('/me&fields=likes,name');
} catch (FacebookApiException $e) {
  error_log($e);
  $user = null;
}

//make sure they haven't been added yet
//$userData = $db->query("SELECT * FROM Users WHERE fbuid = %d LIMIT 1", $user);
//$existing_user = mysql_fetch_assoc($userData);

//print json_encode($userData);
