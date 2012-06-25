<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class ContentController extends AbstractController
{
	public function FactoryController()
	{
		if(file_exists(PATH_CONTENT.$this->param[0].".php"))
		{
			include_once(PATH_VIEW."content.php");
			$this->view = new ContentView();
			return $this->view->StaticView($this->param[0]);
		}
		else
		{
			throw new pyBashException("Contentfile doen't exists!");
			return false;
		}
	}

}
