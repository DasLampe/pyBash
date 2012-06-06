<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
/**
 * 
 * Log Impeesa actions for easy Debug
 * @author DasLampe
 *
 */
class impeesaLog
{
	static function msg($msg)
	{
		$db		= impeesaDB::getConnection();
		
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
		$db		= impeesaDB::getConnection();
		
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
		$db		= impeesaDB::getConnection();
		
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
		$db		= impeesaDB::getConnection();
		
		$clear	= $db->query("TRUNCATE TABLE ".MYSQL_PREFIX."log");
		
		if($clear)
		{
			impeesaLog::msg("Clear log database successful");
			return true;
		}
		else
		{
			impeesaLog::error("Clear log database fail!");
			return false;
		}
	}
	
	static function delete_old_logs($timestamp)
	{
		$db		= impeesaDB::getConnection();
		
		$clear	= $db->prepare("DELETE FROM ".MYSQL_PREFIX."log
								WHERE timestamp <= :timestamp");
		$clear->bindParam(":timestamp",		$timestamp, PDO::PARAM_INT);
		
		if($clear->execute())
		{
			impeesaLog::msg("Delete old logs. Older than: ".date('d.m.Y H:i', $timestamp));
			return true;	
		}
		else
		{
			impeesaLog::error("Can't delete old logs. Older than: ".date('d.m.Y H:i', $timestamp).'('.$timestamp.')');
			return false;
		}
	}
}