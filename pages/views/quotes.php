<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class QuotesView extends AbstractView
{
	public function MainView()
	{
		include_once(PATH_MODEL."quotes.php");
		$this->model	= new QuotesModel();
		
		$quote_blocks	= "";
		foreach($this->model->GetRandomQuotes() as $quote)
		{
			$this->tpl->vars("ID",				$quote['id']);
			$this->tpl->vars("inserted",		$quote['inserted']);
			$this->tpl->vars("reporter_name",	$quote['reporter_name']);
			$this->tpl->vars("quote",			nl2br(htmlspecialchars($quote['quote'])));
			
			$quote_blocks	.= $this->tpl->load("quote_block", PATH_PAGES_TPL."quotes/");
		}
		
		$this->tpl->vars("headline",	"Zitate");
		$this->tpl->vars("content",		"<h2>Zufallszitate</h3>".$quote_blocks);
		return $this->tpl->load("content");
	}
	
	public function QuoteView($quote_id)
	{
		include_once(PATH_MODEL."quotes.php");
		$this->model	= new QuotesModel();
		
		$quote	= $this->model->GetQuote($quote_id);
		
		if(!$quote)
		{
			throw new pyBashException('Quote: ID:'.$quote_id.' not exist!');
		}
		
		$this->tpl->vars("inserted",		$quote['inserted']);
		$this->tpl->vars("reporter_name",	$quote['reporter_name']);
		$this->tpl->vars("quote",			nl2br(htmlspecialchars($quote['quote'])));
		
		return $this->tpl->load("quote", PATH_PAGES_TPL."quotes/");
	}
}