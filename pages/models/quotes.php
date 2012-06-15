<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class QuotesModel extends AbstractModel
{
	public function GetRandomQuotes($random_quotes=3)
	{
		$sth		= $this->db->prepare("SELECT id, inserted, reporter_name, quote
									FROM ".MYSQL_PREFIX."quotes
									ORDER BY RAND()
									LIMIT :random_quotes");
		$sth->bindParam(":random_quotes",		$random_quotes, PDO::PARAM_INT);
		$sth->execute();
		
		return $sth->fetchAll();
	}
	
	public function GetQuote($quote_id)
	{
		$sth		= $this->db->prepare("SELECT id, inserted, reporter_name, quote
										FROM ".MYSQL_PREFIX."quotes
										WHERE id = :quote_id");
		$sth->execute(array(':quote_id' => $quote_id));
		return $sth->fetch();
	}
}