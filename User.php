<?php
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
		
		$validUser = $this->checkForNewUser();
		errorLog("valid user is " . $validUser);
		if(!$validUser)
			$this->createNewUser();
	}
	
	public function getUser()
	{
		$db = new DB();
		$sql = 'SELECT * FROM Users WHERE fbuid='.$this->userData['baseData']['id'];
		$result = $db->query($sql);
		return $result;
	}
	
	/*public function postResult()
	{
		$wall_post = array('access_token'=>$access_token,
				'mission' => 'http://samples.ogp.me/442811099074399', // //Object we are operating on
				'caption' => 'Bullets go through these Reapers like butter. We need to clear them out of town. Click for free Cash',
				'link' => 'http://grimdev.kaboomsocial.com?blah=true',
				//'description' => 'this is a description',
				'picture' => 'http://grimdev.kaboomsocial.com/media/images/assets/fb_icons/icon_chomper_female.png',
				'actions' => array(array('name' => 'Get Cash',
						'link' => 'http://grimdev.kaboomsocial.com?blah=true'))
		);
		 
		
		$result = $this->fb->api('/' . $this->userData['baseData']['id'] . '/fbhackeruptive' . ':kill' ,'POST', $wall_post);
		KaboomDump($result);
		KaboomDebug('result: ' . $result);
		return $result;
	}*/
	
	public function getRandomOpponent()
	{
		$db = new DB();
		$sql = 'SELECT * FROM Users WHERE fbuid!='.$this->userData['baseData']['id'];
		$result = $db->query($sql);
		$item = rand(0, count($result)-1);
		return $result[$item];
	}
	
	private function checkForNewUser()
	{
		$db = new DB();
		$sql = 'SELECT * FROM Users WHERE fbuid='.$this->userData['baseData']['id'];
		$result = $db->query($sql);
		return (isset($result) && count($result) > 0);
	}
	
	public function createNewUser()
	{
		try 
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
					$armor_id.
				')';
		errorLog($sql);
		$db->query($sql);
		} catch (Exception $e)
		{
			errorLog($e->getMessage());
		}
	}
	
	/*private function setupHealth()
	{
		$posts = $this->userData['userPosts'];
		$dates = array();
		$secPerDay = 24*60*60;
		
		foreach($posts as $post)
		{
			$date = strtotime($post['created_time']);
			if(count($dates) > 0)
			{
				$curDate = (count($dates-1));
				if($dates[ $curDate ] - $date < $secPerDay)
					$dates[$curDate]++;
				else
					$dates[$curDate + 1] = 1;
			}
				$dates[0] = 1;
		}
		$total = 0;
		foreach($dates as $date)
		{
			$total += $date;
		}
		return ( (round($total/count($dates))/25) < 25)?25:round($total/count($dates))/25;
	}*/
}
?>