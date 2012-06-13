<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 DasLampe <andre@lano-crew.org> |
// | Encoding: UTF-8 |
// +----------------------------------------------------------------------+
class pyBashTemplate
{
	private static $instance = NULL;
	 
	protected $templateFile;
	protected $templateFolder;
	protected $template;
	protected $templateExtension;
	protected $templateLoad;
	protected $leftDelimiter = "{";
	protected $rightDelimiter = "}";
	protected $cachePath;
	private $cacheFile;
	public $vars;
	public $globalVars;
	 
	public $css;
	public $js;
 
	public static function getInstance()
	{
		if(null === self::$instance)
		{
			self::$instance = new self();
		}
		return self::$instance;
	}
	 
	public function __construct()
	{
		$this->templateFolder		= PATH_TPL;
		$this->templateExtension	= "php";
		$this->cachePath			= PATH_MAIN."tmp/";
		
		$this->standart_vars();
	}
	
	private function standart_vars()
	{
		$this->vars("LINK_MAIN", 	LINK_MAIN);
	}
	 
	public function load($tplFile, $tplFolder="", $output=0)
	{
		if(empty($tplFolder))
		{
			$tplFolder = $this->templateFolder;
		}		 
		return $this->getTemplate($tplFile, $tplFolder, $output);
	}
	 
	private function getTemplate($tplName, $tplFolder, $output)
	{
		$this->templateFile = $tplName . "." . $this->templateExtension;
		$template = $tplFolder . $tplName . "." . $this->templateExtension;
		 
		//Wenn Template von Externem Server
		if($this->externTemplate($tplFolder) === true)
		{
			echo '[Error] Es können keine Templates von externen Servern geladen werden!';
			return false;
		}
		 
		//Wenn Template Datei nicht exisiert
		if(!file_exists($template))
		{
			echo '[Error] Template Datei: '.$template.' konnte nicht geladen werden!';
			return false;
		}
		 
		//Lade Template Datei
		$this->templateLoad = @implode("", file($template));
		 
		if($this->templateLoad === false)
		{ //Laden der Template Datei fehlgeschlagen
			echo '[Error] Template Datei: '.$template.' konnte nicht geladen werden!';
			return false;
		}
		 
		//Ersetzen von Variablen
		$this->replace();
		 
		return $this->caching($output);
	}
	 
	private function externTemplate($tplFolder)
	{
		if(preg_match("/^(http|https|ftp):\/\//si", $tplFolder))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	 
	public function vars($name, $value, $global=0)
	{
		if($global==1)
		{
			$this->globalVars["$name"] = $value;
		}
		else
		{
			$this->vars["$name"] = $value;
		}
	}
		 
	private function replace()
	{
		$this->replace_ifs();
		$this->replace_vars();
	}
	 
	private function replace_vars()
	{
		if(!empty($this->vars))
		{	 
			foreach($this->vars as $var_key => $var_value)
			{
				$this->templateLoad = str_replace($this->leftDelimiter.$var_key.$this->rightDelimiter, $var_value, $this->templateLoad);
			}
		}
	}
	 
	private function replace_vars_if($var)
	{
		$var = trim($var);
		$anhang = preg_split('/'.$this->leftDelimiter.'(.*)'.$this->rightDelimiter.'/i', $var);
	 
		$var = str_replace(array($this->rightDelimiter, $this->leftDelimiter, $anhang[1]), "", $var);
		$return = "\$this->vars['".$var."']".$anhang[1];
	 
		return $return;
	}
	 
	private function replace_ifs()
	{
		$this->templateLoad = preg_replace_callback('/'.$this->leftDelimiter.'if'.$this->rightDelimiter.'(.*)'.$this->leftDelimiter.'\/if'.$this->rightDelimiter.'/i', array(&$this, 'controlStructur'), $this->templateLoad);
		$this->templateLoad = preg_replace('/'.$this->leftDelimiter.'\/endif'.$this->rightDelimiter.'/i', '<?php } ?>', $this->templateLoad);
	}
	 
	private function controlStructur($arg)
	{
		return "<?php if(".$this->replace_vars_if($arg[1]).") { ?>";
	}
	 
	private function caching($output)
	{
		$this->cacheFile = $this->cachePath.str_replace("/", "_", $this->templateFile);
	 
		$templateFile = fopen($this->cachePath.str_replace("/", "_", $this->templateFile),"w");
		$cacheFile = fwrite($templateFile, $this->templateLoad);
		fclose($templateFile);
	 
		return $this->output($this->cacheFile, $output);
	}
	 
	private function output($file, $output)
	{
		if($output == 1)
		{
			include($file);
		}
		else
		{
			ob_start();
			include($file);
			$return = ob_get_contents();
			ob_end_clean();
			return $return;
		}
	 
		return false;
	}
	 
	public function addCss($file, $link="")
	{
		if(empty($link))
		{
			$this->css[] = LINK_CSS . $file;
		}
		else
		{
			$this->css[] = $link.$file;
		}
	}
	 
	public function addJs($file, $link="", $important=0)
	{
		if(empty($link))
		{
			$this->js[] = array(
								"file"		=> LINK_JS . $file,
								"important" => $important
								);
		}
		else
		{
			$this->js[]	= array(
								"file"		=> LINK_MAIN.$link . $file,
								"important"	=> $important);
		}
	}
}