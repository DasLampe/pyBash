<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class SidebarController extends AbstractController {
	function factoryController()
	{
		include_once(PATH_VIEW."sidebar.php");
		$this->view			= new SidebarView();
		
		$return_content		= $this->view->MainView();
		
		/*
		 * If Page has sidebarview.
		 * @TODO: Check if exists method SidebarView
		 */
		if($this->param[0] == "quotes")
		{
			include_once(PATH_VIEW."quotes.php");
			$view		= new QuotesView();
			$return_content .= $view->SidebarView();
		}
		
		return $return_content;
	}
}