<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
abstract class AbstractController {
	protected $param;
	protected $view;
	
	public function __construct($param)
	{
		$this->param = $param;
	}
	
	abstract public function factoryController();
}