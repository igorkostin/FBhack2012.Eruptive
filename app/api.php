<?php 
define('APP_ID', '346459112112091');
define('APP_SECRET', '5496850cbe8b7e287c28fd44de02ac14');

require_once('../FB/src/facebook.php');
require_once("../db.php");
$db = new DB;

//$db->install_tables();
$facebook = new Facebook(array(
  'appId'  => APP_ID,
  'secret' => APP_SECRET,
));

$user = $facebook->getUser();
if (!isset($user)) {
	return "NOT AUTHORIZED";
}

$method = $_REQUEST['method'];

if ($method=='getUserInfo')
	getUserInfo( $facebook );
else
	print "UNKNOWN METHOD";
	


function getUserInfo( $facebook ) {
	try {
		// Proceed knowing you have a logged in user who's authenticated.
		$user_info = $facebook->api('/me&fields=likes,name');
		$userData = $user_info;
	} catch (FacebookApiException $e) {
		error_log($e);
		$user = null;
	}
	print json_encode( $userData );
}


//make sure they haven't been added yet
//$userData = $db->query("SELECT * FROM Users WHERE fbuid = %d LIMIT 1", $user);
//$existing_user = mysql_fetch_assoc($userData);

