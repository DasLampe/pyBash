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
		
		$qoute_blocks	= "";
		foreach($this->model->GetRandomQuotes() as $qoute)
		{
			$this->tpl->vars("ID",				$qoute['id']);
			$this->tpl->vars("inserted",		$qoute['inserted']);
			$this->tpl->vars("reporter_name",	$qoute['reporter_name']);
			$this->tpl->vars("qoute",			nl2br(htmlspecialchars($qoute['quote'])));
			
			$qoute_blocks	.= $this->tpl->load("qoute_block", PATH_PAGES_TPL."qoutes/");
		}
		
		$this->tpl->vars("headline",	"Zitate");
		$this->tpl->vars("content",		"<h2>Zufallszitate</h3>".$qoute_blocks);
		return $this->tpl->load("content");
	}
}