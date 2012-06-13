<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
abstract class AbstractModel {
	protected $db;
	
	public function __construct()
	{
		$this->db	= pyBashDb::getConnection();
	}
}