<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
include_once("config/config.php");

$param = (!empty($_GET['param'])) ? explode("/", $_GET['param']) : array("home");

if($param[0] == "resource")
{
	include_once(PATH_CORE_CONTROLLER."resource.controller.php");
	new resourceController($param);
}
else
{
	$pageController	= new pageController($param);
	$pageController->render();
}
?>
