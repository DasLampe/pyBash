<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class pyBashUser {
	private $session;
	private $user_id;
	
	public function __construct($session)
	{
		$this->session	= $session;
		$this->db		= pyBashDb::getConnection();
	}
	
	public function IsLogin()
	{
		if(isset($this->session['userId']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function SetUserId($userinfo)
	{
		if(!is_numeric($userinfo))
		{
			$sth	= $this->db->prepare("SELECT id
						FROM ".MYSQL_PREFIX."users
						WHERE username LIKE :username");
			$sth->execute(array(":username" => $userinfo));
			$row	= $sth->fetch();
			
			if(!$row)
			{
				return false;
			}
			
			$this->user_id = $row['id'];
			
		}
		else
		{
			$this->user_id = $userinfo;
		}
	}
	
	public function SetUserIdByUsername($username)
	{
		if($this->SetUserId($username) === false)
		{
			return false;
		}
		return true;
	}
	
	public function GetPassword()
	{
		$sth	= $this->db->prepare("SELECT password
					FROM ".MYSQL_PREFIX."users
					WHERE id = :userID");
		$sth->execute(array(":userID" => $this->user_id));
		$row	= $sth->fetch();
		return $row['password'];
	}
	
	public function GetSalt()
	{
		$sth	= $this->db->prepare("SELECT salt
					FROM ".MYSQL_PREFIX."users
					WHERE id = :userID");
		$sth->execute(array(":userID" => $this->user_id));
		$row	= $sth->fetch();
		return $row['salt'];
	}
}