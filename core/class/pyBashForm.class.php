<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class pyBashForm {
	private $tpl;
	private $error_msg;
	
	public function __construct()
	{
		$this->tpl			= pyBashTemplate::getInstance();
		$this->error_msg	= array();
	}
	
	public function GetForm(array $fields, $action, $method="post")
	{
		$this->tpl->vars("fields",		$this->GetFormFields($fields));
		$this->tpl->vars("action",		$action);
		$this->tpl->vars("method",		$method);
		$this->tpl->vars("error_msg",	$this->GetErrorMsg());
		return $this->tpl->load("form");
	}
	
	public function SetErrorMsg($msg)
	{
		$this->error_msg[]	= $msg;
	}
	
	public function Validation(array $fields, array $data)
	{
		$return = True;
		foreach($fields as $field)
		{
			if($field[0] == "fieldset")
			{
				$return = $this->Validation($field[2], $data);
				continue;
			}
			
			//check if field required, have value
			if(isset($field[4]) && $field[4] == True && empty($data[$field[2]]))
			{
				$this->error_msg[]	= 'Bitte Feld "'.$field[1].'" ausfüllen!';
				$return = False;
			}

			switch($field[1])
			{
				case "text":
					break;
				case "password":
					if(strlen($data[$field[2]]) < 6)
					{
						$this->error_msg[]	= 'Passwort aus Feld "'.$field[1].'" ist zu kurz. Mindeslänge 6 Zeichen!';
						$return = False;
					}
					if(preg_match("/^([a-z]|[0-9]|[^\w]){6,}$/i", $data[$field[2]]))
					{
						$this->error_msg[]	= 'Passwort aus Feld "'.$field[1].'" ist zu schwach. Bitte mindestens 2 Zeichengruppen verwenden (Sonderzeichen, Buchstaben, Zahlen)';
						$return = False;
					}
					break;
				case "textarea":
					break;
			}
		}
		return $return;
	}
	
	private function GetErrorMsg()
	{
		$return		= "";
		foreach($this->error_msg as $msg)
		{
			$this->tpl->vars("message", 	$msg);
			$return	.= $this->tpl->load("_form_error_msg");
		}
		$this->tpl->vars("error_message",		$return);
		return $this->tpl->load("_form_error");
	}
	
	private function GetFormFields(array $fields)
	{
		$form_fields	= "";
		foreach($fields as $field)
		{
			$form_fields	.= $this->GetFormField($field);
		}
		return $form_fields;
	}
	
	private function GetFormField(array $field)
	{
		$field[3] = (isset($field[3]) ? $field[3] : "");
		$field[4] = (isset($field[4]) ? $field[4] : "");
			
		$this->tpl->vars("label",		$field[1]);
		$this->tpl->vars("name",		$field[2]);
		$this->tpl->vars("value",		$field[3]);
		$this->tpl->vars("required",	$this->isRequiredField($field[4]));
			
		switch(strtolower($field[0]))
		{
			case 'fieldset':
				$this->tpl->vars("fields",	$this->GetFormFields($field[2]));
				
				//redefine label
				$this->tpl->vars("label",		$field[1]);
				return $this->tpl->load("_form_fieldset");
				break;
			case 'text':
				return $this->tpl->load("_form_text");
				break;
			case 'password':
				return $this->tpl->load("_form_pass");
				break;
			case 'hidden':
				return $this->tpl->load("_form_hidden");
				break;
			case 'textarea':
				return $this->tpl->load("_form_textarea");
				break;
			case 'submit':
				return $this->tpl->load("_form_submit");
				break;
		}
	}
	
	private function IsRequiredField($required)
	{
		if($required == false || empty($required))
		{
			return '';
		}
		else
		{
			return 'required';
		}
	}
}
