<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+

class pyBashDb {
	private static $db = NULL;
 
	public function __construct()
	{
	}
 
	public function __clone()
	{
	}
 
	public static function getConnection()
	{
		if(self::$db == NULL)
		{
			try
			{
				self::$db	= new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB, MYSQL_USER, MYSQL_PASS);
				if($_SERVER['HTTP_HOST'] == "localhost")
				{
					self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
				}
				self::$db->exec("SET CHARACTER SET utf8");
			}
			catch(Exeptions $e)
			{
				die("Datenbank Verbindung fehlgeschlagen");
			}
		}
		return self::$db;
	}
}
	
	/*function __construct()
	{
		try
		{
			return $dbh	= new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DB, MYSQL_USER, MYSQL_PASS);	
		}
		catch(PDOException $e)
    	{
    		echo $e->getMessage();
    		die("Fehler beim Datenbank Verbindungsaufbau!");
    	}
	}*/