<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class pyBashException extends Exception
{
	public function __construct($message, $code = 0, Exception $previous = null) {
		parent::__construct($message, $code, $previous);
	}
	
	public function getCustomMessage()
	{
		$exception_number	= $this->saveException();
		$tpl				= pyBashTemplate::getInstance();
		$tpl->vars("exception_number",		$exception_number);
		return $tpl->load("error_exception");
	}
	
	private function saveException()
	{
		$db					= pyBashDb::getConnection();
		$exception_number	= substr(md5(uniqid(time(), TRUE)), 0, 5);
		$sth	= $db->prepare("INSERT INTO ".MYSQL_PREFIX."debug
					(message, trace, timestamp, exception_number)
					VALUES
					(:message, :trace, :timestamp, :exception_number)");
		$sth->execute(array(":message"	=> $this->getMessage(), ":trace" => $this->getTraceAsString(), ":timestamp" => time(), "exception_number" => $exception_number));
		return $exception_number;
	}
}