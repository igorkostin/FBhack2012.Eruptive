<?php
require('./db.php');
class User
{
	private $fb;
	private $userData;
	private $stats;
	
	/**
	 * 
	 * @param Facebook $fb
	 */
	public function __construct($fb)
	{
		$this->fb = $fb;
		
		$this->userData['baseData'] = $fb->api('/me/');
		$this->userData['userLikes'] = $fb->api('/me/likes');
		$this->userData['userFriends'] = $fb->api('/me/friends');
		$this->userData['userPosts'] = $fb->api('/me/posts');
		
		if(!$this->checkForNewUsr())
			createNewUser();
	}
	
	private function checkForNewUsr()
	{
		$db = new DB();
		$sql = 'SELECT * FROM Users WHERE fbuid='.$this->userData['baseData']['id'];
		$result = $db->query($sql);
		errorLog((isset($result) && count($result) > 0));
		return (isset($result) && count($result) > 0);
	}
	
	public function createNewUser()
	{
		$db = new DB();
		
		$fbuid = $this->userData['baseData']['id'];
		$name = preg_replace('/ [A-Za-z0-9]*$/', '', $this->userData['baseData']['name']);
		$energy = 20; //test value
		$xp = 0;
		$level = 1;
		$health = 20; //test value
		$attack = 10; //test value
		$defense = 10; //test value
		$weapon_id = 0; //test value
		$armor_id = 0; //test value
		
		$sql = 'INSERT INTO Users (fbuid, name, energy, xp, level, health, attack, defense, weapon_id, armor_id)
				VALUES ('.
					$fbuid.','.
					'\''.$name.'\','.
					$energy.','.
					$xp.','.
					$level.','.
					$health.','.
					$attack.','.
					$defense.','.
					$weapon_id.','.
					$armor_id.','.
				')';
		errorLog($sql);
		$db->query($sql);
	}
}
?>