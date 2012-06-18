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
	
	public function InsertQuote($reporter_name, $quote)
	{
		$quote	= trim($quote);
		
		//remove timestamp
		$quote	= preg_replace("/(\(|\[)?[0-2][0-9]((:|-)[0-5][0-9]){2}(\)|\])?/", "", $quote);
		//formating username		
		$quote	= preg_replace("/^\s?<?([a-z_0-9]{5,})(>|:)?\s/im", '<$1> ', $quote);

		$sth		= $this->db->prepare("INSERT INTO ".MYSQL_PREFIX."quotes
									(reporter_name, quote)
									VALUES
									(:reporter_name, :quote)");
		return $sth->execute(array("reporter_name" => $reporter_name, ":quote" => $quote));
	}
}