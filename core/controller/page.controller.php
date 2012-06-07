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
		$param				= $this->param;
		$tpl				= $this->tpl;
		$page				= "";
		if(file_exists(PATH_CONTROLLER.$this->param[0].".php"))
		{
			$page			= $this->param[0];
		}
		else
		{
			$page			= "404";
		}

		ob_start("pyBashPostProccess::protectEmail");
		include_once(PATH_TPL."layout.php");
		ob_end_flush();
	}
}
