<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class SidebarView extends AbstractView {
	public function MainView()
	{
		include_once(PATH_MODEL."sidebar.php");
		$this->model	= new SidebarModel();
		
		$this->tpl->vars("total_quotes",	$this->model->GetTotalQuotes());
		$this->tpl->vars("queue_quotes",	$this->model->GetQueueQuotes());
		$this->tpl->vars("top_reporter",	$this->model->GetTopReporter());
		
		return $this->tpl->load("info", PATH_PAGES_TPL."sidebar/");
	}
}