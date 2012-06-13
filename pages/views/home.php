<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class HomeView extends AbstractView
{
	public function MainView()
	{
		$this->tpl->vars("headline",		"pyBash");
		$this->tpl->vars("content",			"pyBash ist ein Gemeinschaftsprojekt der Pytal.de User Community.<br/>
											Hier werden Zitate aus dem Jabber Chat gesammelt.<br/>
											Schaut doch mal bei uns vorbei! :)");
		return $this->tpl->load("content_p");
	}
}
?>