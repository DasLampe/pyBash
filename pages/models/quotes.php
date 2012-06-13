<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class QuotesModel extends AbstractModel
{
	public function GetRandomQuotes($random_quotes=3)
	{
		$stmt	= $this->db->prepare("SELECT id, inserted, reporter_name, quote
									FROM ".MYSQL_PREFIX."quotes
									ORDER BY RAND()
									LIMIT :random_quotes");
		$stmt->bindParam(":random_quotes",		$random_quotes, PDO::PARAM_INT);
		$stmt->execute();
		
		return $stmt->fetchAll();
	}
}