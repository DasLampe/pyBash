<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
header('Content-Type: text/html; charset=utf-8');
session_start();
error_reporting(E_ALL);

include_once(dirname(__FILE__)."/path.conf.php");
include_once(dirname(__FILE__)."/db.conf.php");
include_once(dirname(__FILE__)."/core.inc.php");
