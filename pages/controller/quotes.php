<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class QuotesController extends AbstractController
{
	public function factoryController()
	{
		include_once(PATH_VIEW."quotes.php");
		$this->view	= new QuotesView();
		
		if(isset($this->param[1]))
		{
			try
			{
				if($this->param[1] == "all")
				{
					return $this->view->AllQuotesView();
				}
				elseif($this->param[1] == "random")
				{
					return $this->view->RandomQuotesView();
				}
				elseif($this->param[1] == "insert")
				{
					return $this->view->InsertQuoteView();
				}
				elseif(is_numeric($this->param[1]))
				{
					return $this->view->QuoteView($this->param[1]);
				}
				else
				{
					throw new pyBashException("Unkown parameter");
				}
			}
			catch (pyBashException $e)
			{
				return $e->getCustomMessage();
			}
		}
		return $this->view->MainView();
	}
}