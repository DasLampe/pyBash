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
				if(is_numeric($this->param[1]))
				{
					return $this->view->QuoteView($this->param[1]);
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