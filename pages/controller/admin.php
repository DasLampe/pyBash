<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class AdminController extends AbstractController {
	public function FactoryController()
	{
		include_once(PATH_CORE_CLASS."pyBashUser.class.php");
		include_once(PATH_VIEW."admin.php");
		
		$user		= new pyBashUser($_SESSION);
		$this->view	= new AdminView();
		
		if($user->isLogin() === false)
		{
			return $this->view->LoginView($_POST, $user);
		}
	}
}