<?php
class User
{
	private $fb;
	private $userData;
	
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
		print_r($this->userData);
	}
	
	public function createNewUser()
	{
		$fbuid = $this->userData['baseData']['id'];
		$name = preg_replace('/ [A-Za-z0-9]*$/', '', $this->userData['baseData']['name']);
		$sql = 'INSERT INTO User (fbuid, name, energy, xp, level, health, attack, defense, weapon_id, armor_id)
				VALUES ()';
		2	fbuid	int(11)			No	None		  Change	  Drop	  Browse distinct values	  Primary	  Unique	  Index	 More
		3	name	varchar(50)	utf8_general_ci		No	None		  Change	  Drop	  Browse distinct values	  Primary	  Unique	  Index	 More
		4	energy	int(11)			No	None		  Change	  Drop	  Browse distinct values	  Primary	  Unique	  Index	 More
		5	xp	int(11)			No	None		  Change	  Drop	  Browse distinct values	  Primary	  Unique	  Index	 More
		6	level	int(11)			No	None		  Change	  Drop	  Browse distinct values	  Primary	  Unique	  Index	 More
		7	health	int(11)			No	None		  Change	  Drop	  Browse distinct values	  Primary	  Unique	  Index	 More
		8	attack	int(11)			No	None		  Change	  Drop	  Browse distinct values	  Primary	  Unique	  Index	 More
		9	defense	int(11)			No	None		  Change	  Drop	  Browse distinct values	  Primary	  Unique	  Index	 More
		10	weapon_id	int(11)			No	None		  Change	  Drop	  Browse distinct values	  Primary	  Unique	  Index	 More
		11	armor_id	int(11)
	}
}
?>