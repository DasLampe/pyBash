<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class pageController
{
	private $param;

	function __construct($param)
	{
		$this->param	= $param;
		$this->tpl		= pyBashTemplate::getInstance();
	}

	function render()
	{
		$page_exists		= false;
		$page				= "";
		if(file_exists(PATH_CONTROLLER.$this->param[0].".php"))
		{
			$page_exists	= true;
			$page			= $this->param[0];
		}
		ob_start("pyBashPostProccess::protectEmail");
		include_once(PATH_MAIN."template/layout.php");
		ob_end_flush();
	}
}
