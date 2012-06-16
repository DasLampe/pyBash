<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class pyBashForm {
	private $tpl;
	
	public function __construct()
	{
		$this->tpl	= pyBashTemplate::getInstance();
	}
	
	public function GetForm(array $fields, $action, $method="post")
	{
		$this->tpl->vars("fields",		$this->GetFormFields($fields));
		$this->tpl->vars("action",		$action);
		$this->tpl->vars("method",		$method);
		return $this->tpl->load("form");
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
		$field[2] = (isset($field[2]) ? $field[2] : ""); //Message dosen't need a name
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
			case 'error':
				return $this->tpl->load("_form_error");
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
