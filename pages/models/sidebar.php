<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class SidebarModel extends AbstractModel {
	public function GetTotalQuotes()
	{
		$sth	= $this->db->query("SELECT COUNT(*)
					FROM ".MYSQL_PREFIX."quotes
					WHERE status = 2");
		$row	= $sth->fetch(PDO::FETCH_NUM);
		return $row[0];
	}
	
	public function GetQueueQuotes()
	{
		$sth	= $this->db->query("SELECT COUNT(*)
					FROM ".MYSQL_PREFIX."quotes
					WHERE status = 1");
		$row	= $sth->fetch(PDO::FETCH_NUM);
		return $row[0];
	}
	
	public function GetTopReporter()
	{
		$sth	= $this->db->query("SELECT reporter_name
					FROM ".MYSQL_PREFIX."quotes
					WHERE status = 2
					GROUP BY reporter_name
					ORDER BY COUNT(id) DESC
					LIMIT 1");
		$row	= $sth->fetch(PDO::FETCH_NUM);
		return $row[0];
	}
}