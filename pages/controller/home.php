<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class HomeController extends AbstractController
{
	public function FactoryController()
	{
		include_once(PATH_VIEW."home.php");
		$this->view	= new HomeView();
		
		return $this->view->MainView();
	}
}
?>