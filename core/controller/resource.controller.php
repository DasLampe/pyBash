<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 DasLampe <andre@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class resourceController
{
	public function __construct(Array $file)
	{
		$path2file	= "";
		for($i=1;$i<count($file);$i++)
		{
			if($i!=1)
			{
				$path2file	.= '/';
			}
			$path2file		.= $file[$i];
		}
		$file	= $path2file;
		$type	= $this->getHeaderType($file);

		if(file_exists(PATH_MAIN.$file))
		{
			if($type =="application/x-httpd-php")
			{
			 	include(PATH_MAIN.$file);
			}
			else
			{
				 header("Content-Type: ".$type);
				 $content		= file_get_contents(PATH_MAIN.$file);
				 $search		= array(
										"{LINK_TPL}",
										"{LINK_MAIN}",
				 						);
				 $replace		= array(
										LINK_TPL,
										LINK_MAIN,
				 						);
				 $content		= str_replace($search, $replace, $content);


				echo $content;
			}
		}
		else
		{
			echo 'Datei ('.$file.') existiert nicht!';
		}
	}

	private function getHeaderType($file)
	{
		$type	= explode(".", $file);
		switch($type[1])
		{
			 case "css":
				$type = "text/css";
				break;
			case "jpg":
				$type = "image/jpg";
				break;
			case "gif":
				$type = "image/gif";
				break;
			case "png":
				$tpye = "image/png";
				break;
			case "js":
				$type = "text/javascript";
				break;
			case "php":
				$type = "application/x-httpd-php";
				break;
		}

		return $type;
	}
}
