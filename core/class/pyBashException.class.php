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
		$exception_id		= substr(md5(uniqid(time(), TRUE)), 0, 5);
		$sth	= $db->prepare("INSERT INTO ".MYSQL_PREFIX."debug
					(message, timestamp, exception_id, trace, exception_file, exception_line, request_uri, request_referer, request_method)
					VALUES
					(:message, :timestamp, :exception_id, :trace, :exception_file, :exception_line, :request_uri, :request_referer, :request_method)");
		$sth->execute(array(
							":message"			=> $this->getMessage(), 
							":timestamp"		=> time(),
							"exception_id"		=> $exception_id,
							":trace"			=> $this->getTraceAsString(),
							":exception_file"	=> $this->getFile(),
							":exception_line"	=> $this->getLine(),
							":request_uri"		=> $_SERVER['REQUEST_URI'],
							":request_referer"	=> $_SERVER['HTTP_REFERER'] = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 0),
							":request_method"	=> $_SERVER['REQUEST_METHOD'],
							));
		return $exception_id;
	}
}