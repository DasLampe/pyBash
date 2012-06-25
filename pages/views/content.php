<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class ContentView extends AbstractView {
	public function MainView()
	{
		/**
		 * Hack! Don't need this function!
		 */
	}
	
	public function StaticView($site)
	{
		ob_start();
		include(PATH_CONTENT.$site.".php");
		$content=ob_get_contents();
		ob_end_clean();
		
		$this->tpl->vars("content", $content);
		return $this->tpl->load("_content");
	}
}