<?php
require_once "modules_class.php";

class RegContent extends Modules{
	
	

	public function __construct($db){
		parent::__construct($db);
	}

	protected function getTitle(){

		return "Регистрация на сайте";
	}
	protected function getDescription(){
		return "Регистрация пользователя";
	}
	protected function getKeywords(){
		return "регистрация сайт, регистрация пользователь сайт";
	}

	protected function getMiddle(){
		$sr["message"] = "";
		$sr["login"] = $_SESSION["login"];
		return $this->getReplaceTemplate($sr, "form_reg");
	}
	
}

?>