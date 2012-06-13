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
		
		return $this->view->MainView();
	}
}