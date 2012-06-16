<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class QuotesModel extends AbstractModel
{
	/**
	 * @param int $from
	 * @param int $number
	 * @return array
	 */
	public function GetAllQuotes($from=0, $number=20)
	{
		$sth		= $this->db->prepare("SELECT id, inserted, reporter_name, quote
									FROM ".MYSQL_PREFIX."quotes
									WHERE status = 2
									ORDER BY inserted DESC, id DESC
									LIMIT :from, :number");
		$sth->bindParam(":from",		$from, PDO::PARAM_INT);
		$sth->bindParam(":number",		$number, PDO::PARAM_INT);
		$sth->execute();
		
		return $sth->fetchAll();
	}
	
	/**
	 * @param int $random_quotes
	 * @return array
	 */
	public function GetRandomQuotes($random_quotes=3)
	{
		$sth		= $this->db->prepare("SELECT id, inserted, reporter_name, quote
									FROM ".MYSQL_PREFIX."quotes
									WHERE status = 2
									ORDER BY RAND()
									LIMIT :random_quotes");
		$sth->bindParam(":random_quotes",		$random_quotes, PDO::PARAM_INT);
		$sth->execute();
		
		return $sth->fetchAll();
	}
	
	/**
	 * Get single quote
	 * @param int $quote_id
	 * @return array
	 */
	public function GetQuote($quote_id)
	{
		$sth		= $this->db->prepare("SELECT id, inserted, reporter_name, quote
										FROM ".MYSQL_PREFIX."quotes
										WHERE id = :quote_id
											AND status = 2");
		$sth->execute(array(':quote_id' => $quote_id));
		return $sth->fetch();
	}
}