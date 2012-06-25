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
		try
		{
			$tpl				= $this->tpl;
	
			//Sidebar
			include_once(PATH_CONTROLLER."sidebar.php");
			$sidebar				= new SidebarController($this->param);
			$tpl->vars("sidebar",	$sidebar->factoryController());
	
			//Content
			if(file_exists(PATH_CONTENT.$this->param[0].".php") && !file_exists(PATH_CONTROLLER.$this->param[0].".php"))
			{
				include_once(PATH_CONTROLLER."content.php");
				$page_controller	= new ContentController($this->param);
			}
			elseif(file_exists(PATH_CONTROLLER.$this->param[0].".php"))
			{
				include_once(PATH_CONTROLLER.$this->param[0].".php");
				$page_controller	= ucfirst($this->param[0]).'Controller';
				$page_controller	= new $page_controller($this->param);
			}
			else
			{
				throw new pyBashException("Error 404");
			}
			$this->tpl->vars("page_content", $page_controller->factoryController());
		}
		catch(pyBashException $e)
		{
			$this->tpl->vars("page_content", $e->getCustomMessage());
		}
		
		
		echo pyBashPostProccess::protectEmail($this->tpl->load("layout"));
	}
}
