<?php

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
		$params["message"] = $this->getMessage();
		$params["login"] = "";
		if(isset($_SESSION["login"]))	
			$params["login"] = $_SESSION["login"];
		return $this->render("form_reg", $params, true);
	}
	
}

?>