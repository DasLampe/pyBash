<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
/**
 * 
 * Log pyBash actions for easy Debug
 * @author DasLampe
 *
 */
class pyBashLog
{
	static function msg($msg)
	{
		$db		= pyBashDB::getConnection();
		
		$insert	= $db->prepare("INSERT INTO ".MYSQL_PREFIX."log
								(msg, timestamp, request_uri, priority)
								VALUES
								(:msg, :timestamp, :request_uri, 0)");
		$insert->bindParam(":msg",			$msg);
		$insert->bindParam(":timestamp",	time());
		$insert->bindParam(":request_uri",	$_SERVER['REQUEST_URI']);
		$insert->execute();
	}
	
	static function warning($msg)
	{
		$db		= pyBashDB::getConnection();
		
		$insert	= $db->prepare("INSERT INTO ".MYSQL_PREFIX."log
								(msg, timestamp, request_uri, priority)
								VALUES
								(:msg, :timestamp, :request_uri, 1)");
		$insert->bindParam(":msg",			$msg);
		$insert->bindParam(":timestamp",	time(), PDO::PARAM_INT);
		$insert->bindParam(":request_uri",	$_SERVER['REQUEST_URI']);
		$insert->execute();
	}
	
	static function error($msg)
	{
		$db		= pyBashDB::getConnection();
		
		$insert	= $db->prepare("INSERT INTO ".MYSQL_PREFIX."log
								(msg, timestamp, request_uri, priority)
								VALUES
								(:msg, :timestamp, :request_uri, 2)");
		$insert->bindParam(":msg",			$msg);
		$insert->bindParam(":timestamp",	time());
		$insert->bindParam(":request_uri",	$_SERVER['REQUEST_URI']);
		$insert->execute();
	}
	
	static function clear_log()
	{
		$db		= pyBashDB::getConnection();
		
		$clear	= $db->query("TRUNCATE TABLE ".MYSQL_PREFIX."log");
		
		if($clear)
		{
			pyBashLog::msg("Clear log database successful");
			return true;
		}
		else
		{
			pyBashLog::error("Clear log database fail!");
			return false;
		}
	}
	
	static function delete_old_logs($timestamp)
	{
		$db		= pyBashDB::getConnection();
		
		$clear	= $db->prepare("DELETE FROM ".MYSQL_PREFIX."log
								WHERE timestamp <= :timestamp");
		$clear->bindParam(":timestamp",		$timestamp, PDO::PARAM_INT);
		
		if($clear->execute())
		{
			pyBashLog::msg("Delete old logs. Older than: ".date('d.m.Y H:i', $timestamp));
			return true;	
		}
		else
		{
			pyBashLog::error("Can't delete old logs. Older than: ".date('d.m.Y H:i', $timestamp).'('.$timestamp.')');
			return false;
		}
	}
}