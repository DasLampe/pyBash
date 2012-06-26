<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class AdminView extends AbstractView {
	public function MainView()
	{
		/**
		 * HACK: Don't use!
		 */
	}
	
	public function LoginView($data, $user)
	{
		include_once(PATH_CORE_CLASS."pyBashForm.class.php");
		$form			= new pyBashForm();
		
		$username		= (isset($data['username'])) ? $data['username'] : "";
		$form_fields	= array(
								array("fieldset", "Login", array(
									array("text", "Username", "username", $username, True),
									array("password", "Passwort", "pass", "", True)
									),
								),
								array("fieldset", "", array(
									array("submit", "Login", "submit"),
									),
								),
							);
		if(!isset($data['submit']) || $form->Validation($form_fields, $data) == False)
		{
			return $form->GetForm($form_fields, LINK_MAIN."/admin/login");
		}
		else
		{
			if($user->SetUserIdByUsername($data['username']) === true && $user->GetPassword() == hash("sha512", $data['pass'].$user->GetSalt()))
			{
				$this->tpl->vars("message",		"Erfolgreich eingeloggt");
				return $this->tpl->load("_message_success");
			}
			else
			{
				$form->SetErrorMsg("Benutzername oder Passwort sind falsch!");
				return $form->GetForm($form_fields, LINK_MAIN."/admin/login");
			}
		}
	}
}