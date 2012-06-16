<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class QuotesView extends AbstractView
{
	/**
	 * In this case redict to RandomQuotesView
	 * Needed by AbstractView.
	 * @see AbstractView::MainView()
	 */
	public function MainView()
	{
		return $this->RandomQuotesView();
	}
	
	/**
	 * Shows all quotes
	 */
	public function AllQuotesView()
	{
		include_once(PATH_MODEL."quotes.php");
		$this->model	= new QuotesModel();
	
		$quote_blocks	= $this->QuoteBlockView($this->model->GetAllQuotes());
	
		$this->tpl->vars("headline",	"Zitate");
		$this->tpl->vars("content",		$quote_blocks);
		return $this->tpl->load("content");
	}
	
	/**
	 * Shows 3 random quotes
	 */
	public function RandomQuotesView()
	{
		include_once(PATH_MODEL."quotes.php");
		$this->model	= new QuotesModel();
		
		$quote_blocks	= $this->QuoteBlockView($this->model->GetRandomQuotes());
		
		$this->tpl->vars("headline",	"Zitate");
		$this->tpl->vars("content",		"<h2>Zufallszitate</h3>".$quote_blocks);
		return $this->tpl->load("content");
	}
	
	/**
	 * Show the single quote
	 * @param int $quote_id
	 * @throws pyBashException, if $quote_id doesn't exist
	 */
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
	
	/**
	 * Show the sidebar submenu
	 */
	public function SidebarView()
	{
		$menu_array	= array(
							array(
									"page_url"		=> LINK_MAIN."quotes/all",
									"page_title"	=> "Alle Zitate",
								),
							array(
									"page_url"		=> LINK_MAIN."quotes/insert",
									"page_title"	=> "Zitat hinzufügen",
								),
							array(
									"page_url"		=> LINK_MAIN."quotes/random",
									"page_title"	=> "Zufallszitate",
								),
							);
		$menu_items	= "";
		foreach($menu_array	as $menu_item)
		{
			$this->tpl->vars("page_url",		$menu_item['page_url']);
			$this->tpl->vars("page_title",		$menu_item['page_title']);
			$menu_items		.= $this->tpl->load("_nav_li");
		}
		
		$this->tpl->vars("submenu_items",		$menu_items);
		return $this->tpl->load("submenu", PATH_PAGES_TPL."sidebar/");
	}
	
	/**
	 * Shows form to insert quote or message about this
	 */
	public function InsertQuoteView()
	{
		return "INSERT!";
	}
	
	/**
	 * Show a quote block
	 * @param array $quotes
	 * @return string (HTML)
	 */
	private function QuoteBlockView(array $quotes)
	{
		$quote_blocks	= "";
		foreach($quotes as $quote)
		{
			$this->tpl->vars("ID",				$quote['id']);
			$this->tpl->vars("inserted",		$quote['inserted']);
			$this->tpl->vars("reporter_name",	$quote['reporter_name']);
			$this->tpl->vars("quote",			nl2br(htmlspecialchars($quote['quote'])));
				
			$quote_blocks	.= $this->tpl->load("quote_block", PATH_PAGES_TPL."quotes/");
		}
		return $quote_blocks;
	}
}